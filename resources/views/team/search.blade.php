<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="mx-auto">
        <div class="flex justify-center items-center h-screen w-full">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-10">Danh Sách Team</h1>

                <div class="bg-gray-200 w-full h-full flex items-start justify-around">
                    <!-- item 1-->
                    <div class="p-7 ">
                        <div class="max-h-[380px] overflow-y-auto">
                            <table class="min-w-full bg-white border border-gray-700">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-700">Mã Team</th>
                                        <th class="py-2 px-4 border-b border-gray-700">Tên Team</th>
                                        <th class="py-2 px-4 border-b border-gray-700">Tên Bộ Phận</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($teams as $team)
                                        <tr class="team-row hover:bg-gray-200 cursor-pointer">
                                            <td class="py-2 px-4 border-b border-gray-700 team-id">{{ $team->id }}
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-700 team-name">{{ $team->name }}
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-700 team-department">
                                                {{ $team->department->name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4">Không tìm thấy kết quả</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- item 2 -->
                    <div class="w-96 h-96 flex flex-col justify-center items-center">
                        {{-- get search  --}}

                        <div class="flex flex-col justify-between">
                            <form action="{{ route('team.searchResult') }}" method="GET">
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <lable>Mã Team</lable>
                                    <input type="text" name="teamId" id="selectedTeamId" placeholder="id"
                                        class="p-1">
                                </div>

                                <div class="flex justify-between items-center mb-10 gap-6">
                                    <button type="submit" class="text-white bg-green-600 px-6 py-2 flex-1">Tìm
                                        kiếm</button>

                                    <a href="{{ route('team.index') }}"
                                        class="text-white bg-red-600 px-6 py-2 flex-1">Trang chủ</a>
                                </div>
                            </form>

                            {{-- go to home page --}}
                            <div class="flex justify-between items-center mb-10 gap-6">
                                <a href="{{ route('team.export', ['teamId' => request('teamId')]) }}"
                                    class="text-white bg-yellow-600 px-6 py-2 flex-1">Xuất Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
