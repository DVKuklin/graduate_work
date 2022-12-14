@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.list') => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
  <div class="container-fluid">
    <h2>
      <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
      <small id="datatable_info_stack">{!! $crud->getSubheading() ?? '' !!}</small>
    </h2>
  </div>
@endsection

@section('content')
  <center>
    <div id="tools_panel" class="form-inline">

        <div class="form-group">

            <label for="inputUsers" class="m-2">Пользователь</label>
            <select id="inputUsers" class="form-control m-2">
                <option selected>Пользователь...</option>
                <option>...</option>
            </select>

            <label for="inputSections" class="m-2">Раздел</label>
            <select id="inputSections" class="form-control m-2">
                <option selected>Название большого раздела</option>
                <option>...</option>
            </select>        
        
            <button type="button" class="btn btn-success m-2" disabled>Применить изменения</button>
        </div>
        
    </div>





      <table  id="crudTable"
              class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0"
              style="max-width:800px">
        <thead>
          <tr>
            <th>Сортировка</th>
            <th>Тема</th>
            <th>Доступ</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <td>1</td>
            <td>Тема</td>
            <td>Доступ</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Тема</td>
            <td>Доступ</td>
          </tr>
          <tr>
            <td>3</td>
            <td>Тема</td>
            <td>Доступ</td>
          </tr> -->
        </tbody>
      </table>
</center>
@endsection

@section('after_styles')
  {{-- DATA TABLES --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  
  {{-- CRUD LIST CONTENT - crud_list_styles stack --}}
  @stack('crud_list_styles')
@endsection

@section('after_scripts')



@endsection
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script>
    const baseURL = document.location.protocol + "//" + document.location.host + "/api/admin/";
    
    let user_id = localStorage.getItem('user_id');

    //Загружаем данные и формируем таблицу
    $.ajax({
        url: baseURL+"get_data_for_user_extended",
        data: {
            user_id: user_id,
            section_id: 5,
            token: "sdfsdfsdfsdfsdf"
        },       
        method: 'post',           
        success: function(data){ 
            if(data.status === "success"){
                // tools_panel.innerHTML=data.user;
                console.log(data.users);

                //Заполняем select пользователи
                let s = '';
                let userActive = '';
                data.users.forEach ((item,index,arr) => {
                    if (index == 0) {
                        userActive == "selected";
                    } else {
                        userActive == "";
                    }
                    s += `<option ${userActive} value="${item.id}">${item.name}</option>`;


                    // console.log(index);
                    // inputUsers.options.push({
                    //     text:item.name,
                    //     value:item.id
                    // });
                    // inputUsers.options[index].text = item.name;
                    // inputUsers.options[index].value = item.id;
                });

                inputUsers.innerHTML = s;
                
                // inputUsers.options.selectedIndex = 0;

                //Заполняем select разделы
                s = '';
                let sectionActive = '';
                data.sections.forEach ((item,index,arr) => {
                    if (index == 0) {
                        sectionActive == "selected";
                    } else {
                        sectionActive == "";
                    }
                    s += `<option ${sectionActive} value="${item.id}">${item.name}</option>`;
                });

                inputSections.innerHTML = s;

                //Заполняем таблицу
                s ='';
                for (let i=0;i<data.themes.length;i++){

                    let permission = '';
                    if (data.themes[i].permission) {
                        permission = 'checked';
                    }

                    s += 
`
<tr>
        <td>${data.themes[i].sort}</td>
        <td>${data.themes[i].theme}</td>
        <td class="text-center">
            <input type="checkbox" ${permission} data-theme_id="${data.themes[i].theme_id}">
        </td>
</tr>
` 
                }

                let tbody = crudTable.querySelector('tbody');
                tbody.innerHTML = s;
            } 
        }
    });
</script>

<style>

</style>