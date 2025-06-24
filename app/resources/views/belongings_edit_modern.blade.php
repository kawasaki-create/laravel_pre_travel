@extends('layouts.app')

@section('content')
@vite(['resources/css/app-modern.css'])

<div class="py-4" style="min-height: 100vh; background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #e3f2fd 100%);">
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="border-left: 4px solid #28a745;">
            <div class="me-3">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="color: #28a745;">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="mb-0" style="color: #155724;">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert" style="border-left: 4px solid #dc3545;">
            <div class="me-3">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="color: #dc3545;">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <p class="mb-0" style="color: #721c24;">{{ session('danger') }}</p>
            </div>
        </div>
    @endif

    <div class="container">
        <!-- Header Section -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold mb-2 d-flex align-items-center" style="color: #212529;">
                    <svg width="32" height="32" class="me-3" style="color: #fd7e14;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    持ち物リスト管理
                </h1>
                <div class="d-flex flex-column flex-md-row">
                    <p class="text-muted mb-1 me-md-4">
                        <svg width="16" height="16" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h6m-6 4h6m-2 4h2" />
                        </svg>
                        {{ $travelPlan->trip_title }}
                    </p>
                    <p class="text-muted mb-0">
                        <svg width="16" height="16" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 14a2 2 0 002 2h4a2 2 0 002-2L15 7m-6 0l1 14a2 2 0 002 2h4a2 2 0 002-2l1-14m-8 0h8" />
                        </svg>
                        {{ $formatted_start }}〜{{ $formatted_end }} ({{ $dateCount }}日間)
                    </p>
                </div>
            </div>
            <a href="/home" class="btn btn-outline-secondary d-flex align-items-center" style="transition: all 0.2s;">
                <svg width="20" height="20" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                ホームに戻る
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row g-4">
                    <!-- Current Items Card -->
                    <div class="col-lg-6">
                        <div class="card shadow-lg border-0" style="border-radius: 16px;">
                            <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 16px 16px 0 0;">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <h3 class="h5 mb-0 fw-bold">持ち物リスト削除</h3>
                                    </div>
                                    <span class="badge bg-light text-dark">{{ count($belongings) }}件</span>
                                </div>
                            </div>

                            @if(count($belongings) > 0)
                                <form action="{{ route('schedule.belongings_delete') }}" method="POST" id="deleteForm">
                                    @csrf
                                    <div class="card-body p-0">
                                        <!-- Select All Header -->
                                        <div class="p-4 border-bottom bg-light">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                    <label class="form-check-label fw-semibold" for="selectAll">
                                                        すべて選択
                                                    </label>
                                                </div>
                                                <small class="text-muted">削除する持ち物を選択してください</small>
                                            </div>
                                        </div>

                                        <!-- Items List -->
                                        <div class="p-3" style="max-height: 400px; overflow-y: auto;">
                                            @foreach($belongings as $row)
                                                <div class="belonging-item p-3 mb-2 rounded" style="background-color: #f8f9fa; border-left: 4px solid #dc3545; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#ffe6e6'" onmouseout="this.style.backgroundColor='#f8f9fa'">
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check me-3">
                                                            <input type="checkbox" name="belongings[]" value="{{ $row->id }}" class="form-check-input item-checkbox" data-id="{{ $row->id }}">
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <span class="fw-semibold">{{ $row->contents }}</span>
                                                        </div>
                                                        <div class="text-muted">
                                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Action Footer -->
                                    <div class="card-footer bg-light border-0 d-flex align-items-center justify-content-between" style="border-radius: 0 0 16px 16px;">
                                        <div class="d-flex align-items-center">
                                            <span class="text-muted small me-3">選択済み: </span>
                                            <span id="selectedCount" class="badge bg-danger">0</span>
                                            <span class="text-muted small ms-1">件</span>
                                        </div>
                                        <button type="submit" class="btn btn-danger" id="deleteButton" disabled style="transition: all 0.2s;">
                                            <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            選択したアイテムを削除
                                        </button>
                                    </div>
                                    <input type="hidden" value="{{ $id }}" name="travel_plan_id">
                                </form>
                            @else
                                <div class="card-body text-center py-5">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);">
                                        <svg width="30" height="30" style="color: #dc3545;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                    <h5 class="fw-bold mb-2">持ち物がありません</h5>
                                    <p class="text-muted">右側のフォームから持ち物を追加してください</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Add Items Card -->
                    <div class="col-lg-6">
                        <div class="card shadow-lg border-0" style="border-radius: 16px;">
                            <div class="card-header text-white border-0" style="background: linear-gradient(135deg, #fd7e14 0%, #e65100 100%); border-radius: 16px 16px 0 0;">
                                <div class="d-flex align-items-center">
                                    <svg width="24" height="24" class="me-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <h3 class="h5 mb-0 fw-bold">持ち物追加</h3>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <form action="{{ route('schedule.belongings_register') }}" method="POST" id="addForm">
                                    @csrf
                                    
                                    <!-- Control Buttons -->
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div>
                                            <button type="button" name="add" class="btn btn-success btn-sm me-2" style="border-radius: 8px;">
                                                <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                項目追加
                                            </button>
                                            <button type="button" name="delete" class="btn btn-outline-danger btn-sm" style="border-radius: 8px;">
                                                <svg width="14" height="14" class="me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                                </svg>
                                                項目削除
                                            </button>
                                        </div>
                                        <span class="badge bg-primary" id="itemCount">1項目</span>
                                    </div>

                                    <!-- Items Container -->
                                    <div id="belongingsContainer" class="belongings" style="max-height: 350px; overflow-y: auto;">
                                        <div class="belonging-input-item mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-secondary me-2" style="min-width: 30px;">1</span>
                                                <input type="text" name="belongings-1" class="form-control" placeholder="持ち物を入力..." style="border-radius: 8px; border: 2px solid #e9ecef;" onfocus="this.style.borderColor='#fd7e14'" onblur="this.style.borderColor='#e9ecef'">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center mt-4">
                                        <button type="submit" name="belongings-register" class="btn btn-lg text-white fw-bold" style="background: linear-gradient(135deg, #fd7e14 0%, #e65100 100%); border-radius: 12px; padding: 12px 30px; transition: all 0.3s; border: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(253,126,20,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                            <svg width="16" height="16" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            持ち物を登録
                                        </button>
                                    </div>

                                    <textarea id="belonginsCnt" name="belonginsCnt" hidden>1</textarea>
                                    <input type="hidden" value="{{ $id }}" name="travel_plan_id">
                                </form>
                            </div>
                        </div>

                        <!-- Helper Card -->
                        <div class="card mt-4 border-info" style="border-radius: 12px;">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <svg width="24" height="24" style="color: #17a2b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-2">持ち物リストのコツ</h6>
                                        <ul class="mb-0 small text-muted">
                                            <li>カテゴリー別に整理すると便利です（衣類、洗面用品、電子機器など）</li>
                                            <li>数量が必要なものは「靴下×3足」のように記載しましょう</li>
                                            <li>重要度の高いものから順に記載することをおすすめします</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom animations */
.belonging-item {
    transform: translateX(0);
    transition: all 0.3s ease;
}

.belonging-item:hover {
    transform: translateX(5px);
}

.belonging-input-item {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Checkbox styling */
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.form-check-input:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

/* Form styling */
.form-control:focus {
    border-color: #fd7e14 !important;
    box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25) !important;
}

/* Button states */
.btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Scrollbar styling */
.card-body::-webkit-scrollbar {
    width: 6px;
}

.card-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.card-body::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.card-body::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete form functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const deleteButton = document.getElementById('deleteButton');
    const selectedCountElement = document.getElementById('selectedCount');
    const deleteForm = document.getElementById('deleteForm');

    // Update selected count and button state
    function updateDeleteUI() {
        const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
        const count = checkedBoxes.length;
        
        selectedCountElement.textContent = count;
        deleteButton.disabled = count === 0;
        
        // Update select all checkbox state
        if (count === 0) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = false;
        } else if (count === itemCheckboxes.length) {
            selectAllCheckbox.indeterminate = false;
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.indeterminate = true;
        }
    }

    // Select all functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            updateDeleteUI();
        });
    }

    // Individual checkbox change
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateDeleteUI);
    });

    // Delete form submission
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');
            if (checkedBoxes.length === 0) {
                e.preventDefault();
                return;
            }

            const count = checkedBoxes.length;
            const confirmMessage = `選択した${count}件の持ち物を削除しますか？\\n\\nこの操作は取り消せません。`;
            
            if (!confirm(confirmMessage)) {
                e.preventDefault();
            }
        });
    }

    // Add form functionality
    const addForm = document.getElementById('addForm');
    const addButton = document.querySelector('button[name="add"]');
    const deleteLastButton = document.querySelector('button[name="delete"]');
    const belongingsContainer = document.getElementById('belongingsContainer');
    const belongingsCntTextarea = document.getElementById('belonginsCnt');
    const itemCountElement = document.getElementById('itemCount');
    
    let currentCount = 1;

    function updateItemCount() {
        itemCountElement.textContent = `${currentCount}項目`;
        belongingsCntTextarea.value = currentCount;
    }

    // Add item functionality
    addButton.addEventListener('click', function() {
        if (currentCount < 20) { // Limit to 20 items
            currentCount++;
            const newItem = document.createElement('div');
            newItem.className = 'belonging-input-item mb-3';
            newItem.innerHTML = `
                <div class="d-flex align-items-center">
                    <span class="badge bg-secondary me-2" style="min-width: 30px;">${currentCount}</span>
                    <input type="text" name="belongings-${currentCount}" class="form-control" placeholder="持ち物を入力..." style="border-radius: 8px; border: 2px solid #e9ecef;" onfocus="this.style.borderColor='#fd7e14'" onblur="this.style.borderColor='#e9ecef'">
                </div>
            `;
            belongingsContainer.appendChild(newItem);
            updateItemCount();
            
            // Focus on the new input
            const newInput = newItem.querySelector('input');
            newInput.focus();
        } else {
            alert('持ち物は最大20個まで追加できます。');
        }
    });

    // Delete last item functionality
    deleteLastButton.addEventListener('click', function() {
        if (currentCount > 1) {
            const lastItem = belongingsContainer.lastElementChild;
            lastItem.remove();
            currentCount--;
            updateItemCount();
        }
    });

    // Form submission validation
    addForm.addEventListener('submit', function(e) {
        const inputs = belongingsContainer.querySelectorAll('input[type="text"]');
        let hasContent = false;
        
        inputs.forEach(input => {
            if (input.value.trim()) {
                hasContent = true;
            }
        });
        
        if (!hasContent) {
            e.preventDefault();
            alert('少なくとも一つの持ち物を入力してください。');
            return;
        }
        
        // Show loading state
        const submitButton = addForm.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>登録中...';
        
        // Reset button state if something goes wrong
        setTimeout(() => {
            if (submitButton.disabled) {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        }, 5000);
    });

    // Initial UI update
    updateDeleteUI();
    updateItemCount();
});
</script>
@endsection