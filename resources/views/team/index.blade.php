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
                                    @foreach ($teams as $team)
                                        <tr class="team-row hover:bg-gray-200 cursor-pointer">
                                            <td class="py-2 px-4 border-b border-gray-700 team-id">
                                                {{ $team->id }}
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
                        <form action="{{ route('team.delete') }}" method="post" onsubmit="return confirmDelete(event)">
                            @csrf
                            @method('DELETE')

                            <div class="flex flex-col justify-between">
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <lable>Mã Team</lable>
                                    <input type="text" name="teamId" id="selectedTeamId" placeholder="id" readonly
                                        class="p-1 bg-slate-100">
                                </div>
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <lable>Tên Team</lable>
                                    <input type="text" name="" id="selectedTeamName" placeholder="name"
                                        disabled class="p-1 bg-slate-100">
                                </div>
                                <div class="flex justify-between items-center gap-8 mb-10">
                                    <label>Bộ Phận</label>
                                    <div className="">
                                        <Select label="Select Version" class="w-[189px] p-1 bg-slate-300">
                                            <Option id="selectedTeamDepartment"></Option>
                                        </Select>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mb-10">
                                    <a class="bg-blue-500 text-white px-6 py-2" href="{{ route('team.add') }}">Thêm</a>
                                    <a class="bg-orange-400 text-white px-6 py-2"
                                        href="{{ route('team.edit') }}">Sửa</a>
                                    <button class="bg-red-500 text-white px-6 py-2" type="submit">Xóa</button>
                                </div>

                                <a href="{{ route('team.search') }}" class="text-white bg-gray-600 px-6 py-2">Tìm kiếm</a>
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

                // console.log("Click", teamId, teamName, teamDepartment);
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

    function confirmDelete(event) {
        // check input id is empty
        const teamId = document.getElementById('selectedTeamId').value;
        if (teamId === '') {
            alert('Vui lòng chọn team cần xóa');
            event.preventDefault();
            return false;
        }
        return confirm('Bạn có chắc chắn muốn xóa team này không?');
    }
</script>

</html>
