
<div class="space-y-4 rounded-t-xl overflow-hidden bg-gradient-to-r from-light-blue-50 to-light-blue-100 p-10">
    {{-- Do your work, then step back. --}}
    <div>
        <x-jet-input wire:model.debounce.500ms="zhNameOrPhone" wire:dirty.class="text-red-500"
            type="text"
            class="w-3/12 px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"
            placeholder="搜尋中文姓名或電話號碼" />
    </div>
    <table class="min-w-full leading-normal table-auto">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    中文姓名</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    英文姓名</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    Email</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    電話</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    分機</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    部門</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    REMOVE ITEM</th>
                <th
                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    EDIT ITEM</th>
            </tr>
        </thead>
        <tbody>
            {{-- 可以改用@each('view.name.compoment', $userList, 'customer', 'view.empty.name.component') --}}
            @forelse($directories as $info)
            <tr wire:loading.class.delay="opacity-50">{{-- 長時間搜尋等待改變畫面狀態。 --}}
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-1/12">
                    <p class="text-gray-900 whitespace-nowrap text-center">
                        {{ $info->chinese_name }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/12">
                    <p class="text-gray-900 whitespace-nowrap text-center">
                        {{ $info->english_name }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-1/12">
                    <p class="text-gray-900 whitespace-nowrap text-center">
                        {{ $info->email }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-1/12">
                    <p class="text-gray-900 whitespace-nowrap text-center">
                        {{ $info->phone }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-1/12">
                    <p class="text-gray-900 whitespace-nowrap text-center">
                        {{ $info->ext }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-1/12">
                    <p class="text-gray-900 whitespace-nowrap text-center">
                        {{ $info->department->dept_name ?? 'none' }}
                    </p>
                </td>
                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/12">
                    <button wire:click="removeFromTableRow({{ $info->id }})"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        移除
                    </button>
                </td>
                <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/12">
                    <button wire:click="editFromTableRow({{ $info->id }})"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        編輯
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <div class="flex justify-center">
                        <span>No data found.</span>
                    </div>
                </td>
            </tr>
            @endforelse
            {{ $directories->links() }}
        </tbody>
    </table>
</div>
