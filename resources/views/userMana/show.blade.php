@extends('layouts.app')
@section('content')

<style>
    .container {
        max-width: 960px;
        margin: 30px auto;
        padding: 20px;
    }

    h1 {
        font-size: 20px;
        text-align: center;
        margin: 20px 0 20px;
    }

    h1 small {
        display: block;
        font-size: 15px;
        padding-top: 8px;
        color: gray;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        right: 0;
        z-index: 1;
        top: 0;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 25px;
        height: 25px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    /* .avatar-upload .avatar-edit input+label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    } */

    .avatar-upload .avatar-preview {
        width: 100%;
        height: 100%;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <div class="grid grid-cols-1 mb-5">
                <div class="flex items-center justify-between">
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">プロフィール</h4>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                            <li class="inline-flex items-center">
                                <a href="/"
                                    class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                    オヤテック
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('userMana.show', ['userMana' => Auth::user()->id]) }}"
                                        class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">プロフィール</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="flex flex-wrap card-body w-full">
                    <div class="nav-tabs border-b-tabs w-full">
                        <ul
                            class="flex flex-wrap w-full text-sm font-medium text-center text-gray-500 border-b border-gray-100 nav dark:border-gray-700 dark:text-gray-400">
                            <li>
                                <a href="javascript:void(0);" data-tw-toggle="tab"
                                    data-tw-target="underline-icon-nickname"
                                    class="inline-block p-4 hover:border-b-2 hover:border-gray-300 active">
                                    <i
                                        class="text-lg align-middle mdi mdi-account-circle-outline ltr:mr-2 rtl:ml-2"></i>ユーザー名
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-tw-toggle="tab" data-tw-target="underline-icon-email"
                                    class="inline-block p-4">
                                    <i
                                        class="text-lg align-middle mdi mdi-email-edit-outline ltr:mr-2 rtl:ml-2"></i>メール変更
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-tw-toggle="tab"
                                    data-tw-target="underline-icon-password"
                                    class="inline-block p-4 hover:border-b-2 hover:border-gray-300">
                                    <i class="text-lg align-middle mdi mdi-shield-key ltr:mr-2 rtl:ml-2"></i>パスワード変更
                                </a>
                            </li>
                        </ul>

                        <div class="mt-5 tab-content">
                            <div class="block tab-pane" id="underline-icon-nickname">
                                <div class="col-span-12 w-full">
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                        <form class="card-body"
                                            action="{{ route('userMana.update', ['userMana' => Auth::user()->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            @if (session('success'))
                                            <div
                                                class="px-5 py-[9px] flex items-center bg-green-50 border border-green-100 rounded alert-dismissible mb-4">
                                                <i
                                                    class="mdi mdi-baby-face-outline ltr:mr-2 rtl:ml-2 align-middle text-green-700 text-lg"></i>
                                                <p class="text-green-700">{{ session('success') }}</p>
                                                <button type="button"
                                                    class="alert-close ltr:ml-auto rtl:mr-auto text-green-400 text-lg">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </div>
                                            @endif
                                            <div class="grid grid-cols-12 mb-5">
                                                <div class="col-span-9">
                                                    <div class="flex flex-wrap items-center">
                                                        <div class="h-20 w-20 ltr:mr-4 rtl:ml-1">
                                                            {{-- <div
                                                                class="bg-gray-100 text-gray-700 h-20 w-20 rounded-full text-center text-3xl font-medium leading-[2.7]">
                                                                {{ substr(Auth::user()->nickname, 0, 2) }}</div> --}}
                                                            @if(Auth::user()->avatar)
                                                            <div class="w-full h-full">
                                                                <div class="avatar-upload relative h-full">
                                                                    <div class="avatar-edit">
                                                                        <input type='file' id="imageUpload"
                                                                            accept=".png, .jpg, .jpeg" />
                                                                        <label for="imageUpload" class="flex justify-center items-center">
                                                                            <i class="mdi mdi-fountain-pen-tip mx-auto"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="avatar-preview">
                                                                        <div id="imagePreview" style="background-image: url({{ asset(Auth::user()->avatar) }});">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <div class="w-full h-full">
                                                                <div class="avatar-upload relative h-full">
                                                                    <div class="avatar-edit">
                                                                        <input type='file' id="imageUpload"
                                                                            accept=".png, .jpg, .jpeg" />
                                                                        <label for="imageUpload" class="flex justify-center items-center">
                                                                            <i class="mdi mdi-fountain-pen-tip mx-auto"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="avatar-preview">
                                                                        <div id="imagePreview" style="background-image: url({{ asset('assets/images/users/default.png') }});">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <h5 class="text-16 mb-1 text-gray-700 dark:text-gray-100">
                                                                {{ Auth::user()->nickname }}
                                                            </h5>
                                                            <p class="text-gray-500 dark:text-zinc-100 text-13">
                                                                {{ Auth::user()->role->name }}
                                                            </p>

                                                            <div class="flex flex-wrap items-start gap-2 text-13 mt-3">
                                                                <div class="text-gray-500 dark:text-zinc-100">
                                                                    <i
                                                                        class="mdi mdi-circle-medium me-1 text-green-500 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                                    {{ Auth::user()->email }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-3">
                                                    <div class="flex flex-wrap justify-end">
                                                        <button type="button" onclick="removeNicknameReadonly()"
                                                            id="editableNickName"
                                                            class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
                                                            <i class="bx bx-edit text-16 align-middle "></i>
                                                        </button>
                                                        <button type="button" onclick="addNicknameReadonly()"
                                                            id="readonlyNickname"
                                                            class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600 hidden">
                                                            <i class="bx bx-window-close text-16 align-middle "></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6 mb-4">
                                                <label for="username"
                                                    class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ユーザー名</label>
                                                <input type="text" placeholder="ユーザー名" id="username" name="nickname"
                                                    value="{{ Auth::user()->nickname }}"
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    readonly>
                                                @error('nickname')
                                                <div
                                                    class="px-5 py-[9px] flex items-center bg-red-50 border border-red-100 rounded alert-dismissible mt-2">
                                                    <i
                                                        class="mdi mdi-block-helper ltr:mr-2 rtl:ml-2 align-middle text-red-700 text-lg"></i>
                                                    <p class="text-red-700">{{ $message }}</p>
                                                    <button type="button"
                                                        class="alert-close ltr:ml-auto rtl:mr-auto text-red-400 text-lg"><i
                                                            class="mdi mdi-close"></i></button>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="submit" id="saveNicknameBtn"
                                                    class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 hidden">
                                                    <i
                                                        class="bx bx-check-double text-16 align-middle ltr:mr-1 rtl:ml-1 "></i>
                                                    <span class="align-middle">保 存</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden tab-pane" id="underline-icon-email">
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                        <form class="card-body" action="{{ route('userMana.requestChangeEmail') }}"
                                            method="POST">
                                            @csrf
                                            <h5 class="text-15 text-gray-700 dark:text-gray-100 mb-3">メール変更</h5>
                                            @if (session('success'))
                                            <div
                                                class="px-5 py-[9px] flex items-center bg-green-50 border border-green-100 rounded alert-dismissible mb-4">
                                                <i
                                                    class="mdi mdi-baby-face-outline ltr:mr-2 rtl:ml-2 align-middle text-green-700 text-lg"></i>
                                                <p class="text-green-700">{{ session('success') }}</p>
                                                <button type="button"
                                                    class="alert-close ltr:ml-auto rtl:mr-auto text-green-400 text-lg">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </div>
                                            @endif
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="mb-4">
                                                    <input type="text" placeholder="メール" id="email" name="email"
                                                        value="{{ Auth::user()->email }}"
                                                        class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100">
                                                    @if(session('error'))
                                                    <div
                                                        class="px-5 py-[9px] flex items-center bg-red-50 border border-red-100 rounded alert-dismissible mt-2">
                                                        <i
                                                            class="mdi mdi-block-helper ltr:mr-2 rtl:ml-2 align-middle text-red-700 text-lg"></i>
                                                        <p class="text-red-700">{{ session('error') }}</p>
                                                        <button type="button"
                                                            class="alert-close ltr:ml-auto rtl:mr-auto text-red-400 text-lg"><i
                                                                class="mdi mdi-close"></i></button>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="submit"
                                                        class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
                                                        <i
                                                            class="bx bx-check-double text-16 align-middle ltr:mr-1 rtl:ml-1 "></i>
                                                        <span class="align-middle">保 存</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden tab-pane" id="underline-icon-password">
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                        <form class="card-body" action="{{ route('userMana.changePassword') }}"
                                            method="POST">
                                            @csrf
                                            <h5 class="text-15 text-gray-700 dark:text-gray-100 mb-3">パスワード変更</h5>
                                            @if (session('success'))
                                            <div
                                                class="px-5 py-[9px] flex items-center bg-green-50 border border-green-100 rounded alert-dismissible mb-4">
                                                <i
                                                    class="mdi mdi-baby-face-outline ltr:mr-2 rtl:ml-2 align-middle text-green-700 text-lg"></i>
                                                <p class="text-green-700">{{ session('success') }}</p>
                                                <button type="button"
                                                    class="alert-close ltr:ml-auto rtl:mr-auto text-green-400 text-lg">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </div>
                                            @endif
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="mb-4">
                                                    <label for="last_password"
                                                        class="block font-medium text-gray-700 dark:text-gray-100 mb-2">以前のパスワード</label>
                                                    <input type="password" placeholder="" id="last_password"
                                                        name="last_password"
                                                        class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100">
                                                    @error('last_password')
                                                    <div
                                                        class="px-5 py-[9px] flex items-center bg-red-50 border border-red-100 rounded alert-dismissible mt-2">
                                                        <i
                                                            class="mdi mdi-block-helper ltr:mr-2 rtl:ml-2 align-middle text-red-700 text-lg"></i>
                                                        <p class="text-red-700">{{ $message }}</p>
                                                        <button type="button"
                                                            class="alert-close ltr:ml-auto rtl:mr-auto text-red-400 text-lg"><i
                                                                class="mdi mdi-close"></i></button>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label for="new_password"
                                                        class="block font-medium text-gray-700 dark:text-gray-100 mb-2">新しいパスワード</label>
                                                    <input type="password" placeholder="" id="new_password"
                                                        name="password"
                                                        class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100">
                                                    @error('password')
                                                    <div
                                                        class="px-5 py-[9px] flex items-center bg-red-50 border border-red-100 rounded alert-dismissible mt-2">
                                                        <i
                                                            class="mdi mdi-block-helper ltr:mr-2 rtl:ml-2 align-middle text-red-700 text-lg"></i>
                                                        <p class="text-red-700">{{ $message }}</p>
                                                        <button type="button"
                                                            class="alert-close ltr:ml-auto rtl:mr-auto text-red-400 text-lg"><i
                                                                class="mdi mdi-close"></i></button>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label for="confirm_password"
                                                        class="block font-medium text-gray-700 dark:text-gray-100 mb-2">パスワード確認</label>
                                                    <input type="password" placeholder="" id="confirm_password"
                                                        name="password_confirmation"
                                                        class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100">
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="submit"
                                                        class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600">
                                                        <i
                                                            class="bx bx-check-double text-16 align-middle ltr:mr-1 rtl:ml-1 "></i>
                                                        <span class="align-middle">保存</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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

<script>
    const removeNicknameReadonly = () => {
        $('#editableNickName').addClass('hidden');
        $('#readonlyNickname').removeClass('hidden');
        $('#username').removeAttr('readonly');
        $('#saveNicknameBtn').removeClass('hidden');
    }

    const addNicknameReadonly = () => {
        $('#readonlyNickname').addClass('hidden');
        $('#editableNickName').removeClass('hidden');
        $('#username').prop('readonly', true);
        $('#saveNicknameBtn').addClass('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        initializeTabs();
        setTabClickEvents();
    });

    function initializeTabs() {
        let activeTabname = localStorage.getItem('activeTab') || 'nickname';

        setActiveTab(activeTabname);
        showActiveContent(activeTabname);
    }

    function setTabClickEvents() {
        document.querySelectorAll('[data-tw-toggle="tab"]').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabname = this.getAttribute('data-tw-target').replace('underline-icon-', '');
                localStorage.setItem('activeTab', tabname);
                setActiveTab(tabname);
                showActiveContent(tabname);
            });
        });
    }

    function setActiveTab(tabname) {
        document.querySelectorAll('[data-tw-toggle="tab"]').forEach(tab => {
            tab.classList.remove('active');
        });
        
        const activeTab = document.querySelector(`[data-tw-target="underline-icon-${tabname}"]`);
        if (activeTab) {
            activeTab.classList.add('active');
        }
    }

    function showActiveContent(tabname) {
        document.querySelectorAll('.tab-pane').forEach(content => {
            content.classList.remove('block');
            content.classList.add('hidden');
        });

        const activeContent = document.getElementById(`underline-icon-${tabname}`);
        if (activeContent) {
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');
        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imageUpload").change(function() {
        readURL(this);

        var formData = new FormData();
        formData.append('avatar', $('#imageUpload')[0].files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('userMana.changeAvatar') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                location.href="{{ route('userMana.show', ['userMana' => Auth::user()->id]) }}";
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

</script>
@endsection