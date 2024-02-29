<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')
</head>

<body>
    <div class="mx-auto">
        <div class="flex justify-center items-center h-screen w-full">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-10">Thêm Team</h1>

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
                                    @foreach ($teams as $team)
                                        <tr class="team-row">
                                            <td class="py-2 px-4 border-b border-gray-700 team-id">{{ $team->id }}
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-700 team-name">{{ $team->name }}
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-700 team-department">
                                                {{ $team->department->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- item 2 -->
                    <div class="w-96 h-96 flex flex-col justify-center items-center">
                        <form action="{{ route('team.store') }}" method="POST">
                            @csrf
                            <div class="flex flex-col justify-between">
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <lable>Mã Team</lable>
                                    <input type="text" name="id" id="selectedTeamId" placeholder="id" required
                                        class="p-1">
                                </div>
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <lable>Tên Team</lable>
                                    <input type="text" name="name" id="selectedTeamName" placeholder="name"
                                        required class="p-1">
                                </div>
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <label>Bộ Phận</label>
                                    <div>
                                        <Select label="Select Version" class="w-[189px] p-1" name="department_id">
                                            @foreach ($departments as $department)
                                                <Option value="{{ $department->id }}" id="selectedTeamDepartment">
                                                    {{ $department->name }}</Option>
                                            @endforeach
                                        </Select>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mb-10">
                                    <button class="bg-green-400 text-white px-6 py-2" type="submit">Xác nhận</button>
                                    <button class="bg-red-500 text-white px-6 py-2 w-[112px]"
                                        onclick="window.location.href='/teams'">Hủy</button>
                                </div>

                                @if (session('error'))
                                    <div class="p-2 mb-4 text-sm text-red-800 rounded-lg bg-white dark:text-red-400 flex justify-between items-center"
                                        role="alert">
                                        <div style="flex-grow: 1; text-align: center;">
                                            <button class="font-semibold">{{ session('error') }}</button>
                                        </div>
                                        <button onclick="closeAlert(event)"
                                            class="text-red-400 hover:text-red-600">X</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function closeAlert(event) {
        let element = event.target;
        while (element.nodeName !== "BUTTON") {
            element = element.parentNode;
        }
        element.parentNode.parentNode.removeChild(element.parentNode);
    }
</script>

</html>
