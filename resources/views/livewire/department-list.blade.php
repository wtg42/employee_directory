<div class="rounded-t-xl overflow-hidden bg-gradient-to-r from-light-blue-50 to-light-blue-100 p-10">
    {{-- Do your work, then step back. --}}
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
                    REMOVE ITEM</th>
            </tr>
        </thead>
        <tbody>
            {{-- 可以改用@each('view.name.compoment', $userList, 'customer', 'view.empty.name.component') --}}
            @forelse($departments as $info)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                    <p class="text-gray-900 whitespace-no-wrap text-center">
                        {{ $info->chinese_name }}
                    </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                    <p class="text-gray-900 whitespace-no-wrap text-center">
                        {{ $info->english_name }}
                    </p>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-center">No data found.</p>
                </td>
            </tr>
            @endforelse
            {{ $departments->links() }}
        </tbody>
    </table>
</div>
