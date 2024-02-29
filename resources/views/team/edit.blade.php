<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>



<body>
    <div class="mx-auto">
        <div class="flex justify-center items-center h-screen w-full">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-10">Sửa Danh Sách Team</h1>

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
                                        <tr class="team-row hover:bg-gray-200 cursor-pointer">
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
                        <form action="{{ route('team.update') }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="flex flex-col justify-between">
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <lable>Mã Team</lable>
                                    <input type="text" name="teamId" id="selectedTeamId" placeholder="id"
                                        class="p-1 bg-slate-100" readonly>
                                </div>
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <lable>Tên Team</lable>
                                    <input type="text" name="teamName" id="selectedTeamName" placeholder="name"
                                        required class="p-1">
                                </div>
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <label>Bộ Phận</label>
                                    <div>
                                        <Select label="Select Version" class="w-[189px] p-1" name="department_name">
                                            @foreach ($departments as $department)
                                                <Option id="selectedTeamDepartment">
                                                    {{ $department->name }}
                                                </Option>
                                            @endforeach
                                        </Select>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mb-10">
                                    <button class="bg-green-400 text-white px-6 py-2" type="submit">Cập nhật</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const teamRows = document.querySelectorAll('.team-row');
        const selectElement = document.getElementById('selectedTeamDepartment');

        teamRows.forEach(function(row) {
            row.addEventListener('click', function() {
                const teamId = this.querySelector('.team-id').innerText;
                const teamName = this.querySelector('.team-name').innerText;
                const teamDepartment = this.querySelector('.team-department').innerText;

                // Gán giá trị vào input fields
                document.getElementById('selectedTeamId').value = teamId;
                document.getElementById('selectedTeamName').value = teamName;
                selectElement.innerHTML = `<option>${teamDepartment}</option>`;
            });
        });
    });

    function closeAlert(event) {
        let element = event.target;
        while (element.nodeName !== "BUTTON") {
            element = element.parentNode;
        }
        element.parentNode.parentNode.removeChild(element.parentNode);
    }
</script>

</html>
