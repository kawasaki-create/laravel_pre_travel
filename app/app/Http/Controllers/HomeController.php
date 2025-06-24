<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\{Tweet, TravelPlan, User, TravelDetail, Belonging, Contact};
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\{MailChangeSendMail, AccountDeleteCompleteSendMail, ContactToAdminSendMail, ContactToUserSendMail};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $cacheKey = 'user_home_data_' . $userId;
        
        // キャッシュから取得（5分間）
        $data = cache()->remember($cacheKey, 300, function () use ($userId) {
            // 旅行プランを取得（N+1問題を回避）
            $travelPlans = TravelPlan::where('user_id', $userId)
                ->with(['tweet' => function ($query) {
                    $query->orderBy('updated_at', 'desc');
                }])
                ->orderBy('trip_start', 'desc')
                ->get()
                ->map(function ($travelPlan) {
                    $formatted_start = Carbon::parse($travelPlan->trip_start)->format('Y-m-d');
                    $formatted_end = Carbon::parse($travelPlan->trip_end)->format('Y-m-d');
                    $travelPlan->trip_start = $formatted_start;
                    $travelPlan->trip_end = $formatted_end;
                    return $travelPlan;
                });
            
            // つぶやきを取得（最新50件に制限）
            $tweets = Tweet::where('user_id', $userId)
                ->orderBy('updated_at', 'desc')
                ->limit(50)
                ->get();
            
            // 現在進行中の旅行を特定
            $tripCnt = 0;
            $duplicatedIdList = [];
            $duplicatedTitleList = [];
            foreach($travelPlans as $travelPlan) {
                if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end) {
                    $tripCnt++;
                    $duplicatedIdList[] = $travelPlan->id;
                    $duplicatedTitleList[] = $travelPlan->trip_title;
                }
            }
            
            // 持ち物を取得
            $belongings = Belonging::whereHas('travelPlan', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get();
            
            return [
                'travelPlans' => $travelPlans,
                'tweets' => $tweets,
                'tripCnt' => $tripCnt,
                'duplicatedIdList' => $duplicatedIdList,
                'duplicatedTitleList' => $duplicatedTitleList,
                'belongings' => $belongings
            ];
        });

        return view('home_new', $data);
    }

    public function handleClick(Request $request)
    {
        $tweet = new Tweet;
        $tweet->tweet = $request->input('tweet');
        $tweet->editFlg = 0;
        $tweet->user_id = auth()->user()->id;
        $tweet->travel_plan_id = $request->input('duplicatedTravel');
        $tweet->save();

        // 保存後のリダイレクトなどの処理を行う
        return redirect()->back()->with('success', 'つぶやきを保存しました！');
    }

    public function tweetDelete(Request $request)
    {
        $selectedTweets = $request->input('tweets');
        if (!empty($selectedTweets)) {
            Tweet::whereIn('id', $selectedTweets)->delete();
        }

        // 削除後のリダイレクトなどの処理を行う
        return redirect('/home')->with('success', 'つぶやきを削除しました！');
    }

    public function allTweetDelete(Request $request)
    {
        $selectedTweets = $request->input('tweets');
        if (!empty($selectedTweets)) {
            Tweet::whereIn('id', $selectedTweets)->delete();
        }

        // 削除後のリダイレクトなどの処理を行う
        return redirect('/home/all_tweet')->with('success', 'つぶやきを削除しました！');
    }

    public function allTweet()
    {
        $userId = Auth::id();
        $tweets = Tweet::where('user_id', $userId)
        ->get()
        ->map(function ($tweet) {
            $formatted_updated = Carbon::parse($tweet->updated_at)->format('Y-m-d');
            $tweet->updated_at = $formatted_updated;
            return $tweet;
        });

        return view('all_tweet_modern',[
            'tweets' => $tweets,
        ]);
    }

    public function renewTweet()
    {
        $url = $_SERVER['REQUEST_URI'];
        $cid = ltrim(strrchr("$url", "/"), '/');
        $id = mb_substr( $cid , 0 , mb_strpos($cid, "?tweetContent=") );

        $encodeNewTweet = ltrim(strrchr("$url", "="), '=');
        $newTweet = urldecode($encodeNewTweet);

        $tweet = Tweet::find($id);
        $tweet->tweet = $newTweet;
        $tweet->user_id = auth()->user()->id;
        $tweet->editFlg = 1;
        $tweet->save();

        // 保存後のリダイレクトなどの処理を行う
        return redirect()->back()->with([
            'success'=> 'つぶやきを更新しました！',
        ]);
    }
    public function email()
    {
        return view('auth.passwords.email');
    }

    public function AccountDeleted(Request $request, $id)
{
    // リンクの検証
    if (!$request->hasValidSignature()) {
        return redirect('/home')->with('danger', 'URLの有効期限が切れています😇');
    }

    // ユーザーに関連するデータの削除
    $travelPlans = TravelPlan::where('user_id', $id)->get();
    
    foreach ($travelPlans as $travelPlan) {
        TravelDetail::where('travel_plan_id', $travelPlan->id)->delete();
        Belonging::where('travel_plan_id', $travelPlan->id)->delete();
        Tweet::where('travel_plan_id', $travelPlan->id)->delete();
    }
    
    TravelPlan::where('user_id', $id)->delete();
    Contact::where('user_id', $id)->delete();
    User::where('id', $id)->delete();

    // アカウント削除完了メールを管理者に送信
    Mail::to(env('MAIL_ADMIN_ADDRESS', env('MAIL_USERNAME')))
        ->send(new AccountDeleteCompleteSendMail($request));

    return redirect('/')->with('success', 'アカウント削除が完了しました👋');
}

    public function changeAddress()
    {
        return view('address_change_modern');
    }

    public function changeAddressOk(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->with('error', 'ログインが必要です');
        }

        $preUser = $user->name;
        $preEmail = $user->email;
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // メールアドレス変更通知を送信
        $mailInstance = new MailChangeSendMail($request, $preUser, $preEmail);
        Mail::send($mailInstance);

        return redirect('/home')->with('success', '名前/メールアドレスを変更しました🤗');
    }

    public function contact()
    {
        $userId = Auth::id();
        $today = date('Y-m-d');
        
        // 今日のお問い合わせ件数をチェック
        $todayContactCount = Contact::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->count();
            
        if ($todayContactCount >= 3) {
            return redirect('/home')->with('danger', 'お問い合わせは1日3回までです。');
        }
        
        return view('contact_modern');
    }

    public function contactConfirm(Request $request)
    {
        $name = $request->input('sender-name');
        $email = $request->input('sender-emailaddress');
        $message = $request->input('sender-message');

        return view('contact_confirm_modern', [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ]);
    }

    public function contactSend($name, $email, $message)
    {
        $contact = new Contact;
        $contact->name = $name;
        $contact->email = $email;
        $contact->message = $message;
        $contact->user_id = Auth::id();
        $contact->save();

        // 管理者にメール送信
        Mail::to(env('MAIL_ADMIN_ADDRESS', env('MAIL_USERNAME')))
            ->send(new ContactToAdminSendMail($name, $email, $message));
            
        // ユーザーにメール送信
        Mail::to($email)->send(new ContactToUserSendMail($name, $email, $message));

        return redirect('/home')->with('success', 'お問い合わせありがとうございます🙏');
    }
}
