@extends('layouts.app')
@section('style')
<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
<!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection
@section('header-title', 'Feedbacks')
@section('header-right')
<div class="w-50 d-flex flex-row-reverse">
    @if ($role->name == 'User' || $role->name == 'Admin')
    <div class="toggle-switch">
        <a href="{{ route('feedbacks.create') }}" class="btn btn-primary btn-sm">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus"
                class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512">
                <path fill="currentColor"
                    d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                </path>
            </svg>
            New
        </a>
    </div>
    @endif
    @if ($role->name == 'Admin')
    <div class="toggle-switch">
        <a href="{{ route('feedbacks.draft.create') }}" class="btn btn-primary btn-sm">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus"
                class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512">
                <path fill="currentColor"
                    d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                </path>
            </svg>
            Draft
        </a>
    </div>
    @endif
</div>
@endsection
@section('content')
@include('components.alert')
<div class="statbox widget box box-shadow">
    <div class="widget-content widget-content-area">
        <table id="style-1" class="table style-1 dt-table-hover non-hover">
            <thead>
                <tr>
                    <th class="checkbox-column dt-no-sorting"> ID </th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Soal</th>
                    <th>Jawaban</th>
                    <th class="text-center">Status</th>
                    <th>tanggal</th>
                    <th class="text-center dt-no-sorting">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                <tr>
                    <td class="checkbox-column"> {{ $feedback->id }} </td>
                    <td class="user-name">{{ $feedback->questioner->name }}</td>
                    <td class="user-name">{{ $feedback->division->name }}</td>
                    <td class="user-name">{!! $feedback->question !!}</td>
                    <td class="user-name">{!! $feedback->answer ?: '<span>-</span>' !!}</td>
                    <td class="text-center">
                        <span
                            class="badge {{ $feedback->status == 1 ? 'badge-danger' : null }} {{ $feedback->status == 2 ? 'badge-warning' : null }} {{ $feedback->status == 3 ? 'badge-success' : null }} {{ $feedback->status == 4 ? 'badge-info' : null }}">
                            {{ $feedback->status == 1 ? 'request' : null }} {{ $feedback->status == 2 ? 'acc' : null }}
                            {{ $feedback->status == 3 ? 'answered' : null }}
                            {{ $feedback->status == 4 ? 'drafted' : null }}
                        </span>
                    </td>
                    <td class="user-name">{{ $feedback->created_at }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            @if (optional(auth()->user()->division)->name == 'Admin')
                            <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-link">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST"
                                onsubmit="return confirm('Anda yakin ingin menghapus feedbacks ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @else
                            @if (optional(auth()->user()->division)->name == 'User')
                            @if ($feedback->status == 2 || $feedback->status == 3)
                            <a href="javascript:void(0)" style="cursor: not-allowed;" class="btn btn-link">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button style="cursor: not-allowed;" type="button" class="btn btn-link">
                                <i class="fas fa-trash"></i>
                            </button>
                            @else
                            <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-link">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST"
                                onsubmit="return confirm('Anda yakin ingin menghapus feedbacks ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                            @else
                            @if ($feedback->status == 3)
                            <a href="javascript:void(0)" style="cursor: not-allowed;" class="btn btn-link">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button style="cursor: not-allowed;" type="button" class="btn btn-link">
                                <i class="fas fa-trash"></i>
                            </button>
                            @else
                            <a href="{{ route('feedbacks.edit', $feedback->id) }}" class="btn btn-link">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button style="cursor: not-allowed;" type="button" class="btn btn-link">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                            @endif
                            @endif

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script>
    // var e;
            c1 = $('#style-1').DataTable({
                headerCallback:function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML='<label class="new-control new-checkbox checkbox-outline-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                },
                columnDefs:[ {
                    targets:0, width:"30px", className:"", orderable:!1, render:function(e, a, t, n) {
                        return'<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                    }
                }],
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5
            });

            multiCheck(c1);
</script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection
