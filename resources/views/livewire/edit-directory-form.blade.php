{{-- 修改表單 --}}
<div class="flex items-center min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto">
        <div class="max-w-md mx-auto my-10 bg-white p-5 rounded-md shadow-sm">
            <div class="text-center">
                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">修改通訊錄</h1>
            </div>
            <div class="m-7">
                <form wire:submit.prevent="submitForm">

                    {{-- <input type="hidden" name="apikey" value="YOUR_ACCESS_KEY_HERE">
                    <input type="hidden" name="subject" value="New Submission from Web3Forms">
                    <input type="checkbox" name="botcheck" id="" style="display: none;"> --}}

                    <div class="mb-6">
                        <label for="chinese_name"
                            class="block mb-2 text-sm text-gray-600 dark:text-gray-400">中文姓名</label>
                        <input wire:dirty.class="text-red-500" wire:model.lazy="chinese_name" type="text"
                            id="chinese_name" placeholder="王小明"
                            class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        @error('chinese_name')<span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="english_name"
                            class="block mb-2 text-sm text-gray-600 dark:text-gray-400">英文姓名</label>
                        <input wire:dirty.class="text-red-500" wire:model.lazy="english_name" type="text"
                            id="english_name" placeholder="John Doe"
                            class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        @error('english_name')<span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email</label>
                        <input wire:dirty.class="text-red-500" wire:model.lazy="email" " id=" email"
                            placeholder="you@company.com"
                            class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        @error('email')<span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">

                        <label for="phone" class="text-sm text-gray-600 dark:text-gray-400">電話</label>
                        <input wire:dirty.class="text-red-500" wire:model.lazy="phone" type="text" " id=" phone"
                            placeholder="0912345678"
                            class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        @error('phone')<span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="ext" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">分機</label>
                        <input wire:dirty.class="text-red-500" wire:model.lazy="ext" id="ext" placeholder="123"
                            class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        @error('ext')<span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-6">
                        <label for="dept" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">部門</label>
                        <select wire:dirty.class="text-red-500" wire:model.lazy="dept" id="dept"
                            class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500">
                            <option value="">請選擇</option>
                            @foreach ($departments as $dept)
                            {{-- wire:model is only set or updated on change. 所以多一個選擇--}}
                            <option value="{{ $dept->id }}" selected="">{{ $dept->dept_name }}</option>
                            @endforeach
                        </select>
                        @error('dept')<span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="text-center mb-6">
                        <span class="w-full inline-flex rounded-md shadow-sm">
                            <button type="submit"
                                class="font-bold w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none"
                                style="transition: all 0.15s ease 0s;">

                                <svg wire:loading wire:target='submitForm' version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                    viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve"
                                    class="animate-spin">
                                    <path opacity="0.2" fill="#000"
                                        d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                                s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                                c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z" />
                                    <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                                C22.32,8.481,24.301,9.057,26.013,10.047z">
                                        {{-- <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20"
                                        dur="1s" repeatCount="indefinite" /> --}}
                                    </path>
                                </svg>
                                更新
                            </button>
                        </span>
                    </div>
                    {{-- <p class="text-base text-center text-gray-400" id="result">
                        {{ session('success_message'); }}
                    </p> --}}
                    @if (session()->has('success_message'))
                    <div class="bg-green-100 p-5 w-full sm rounded">
                        <div class="flex justify-between">
                            <div class="flex space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="flex-none fill-current text-green-500 h-4 w-4">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z">
                                    </path>
                                </svg>
                                <div class="flex-1 leading-tight text-sm text-green-700 font-medium">
                                    {{ session('success_message') }}
                                </div>
                            </div>
                            <svg wire:click="dismissSuccessMessage" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" class="flex-none fill-current text-green-600 h-3 w-3">
                                <path
                                    d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
{{-- 修改表單 --}}
