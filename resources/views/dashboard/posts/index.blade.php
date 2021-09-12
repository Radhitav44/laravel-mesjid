@extends('layouts.app')
@section('style')
<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/tables/table-basic.css') }}">
<link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection
@section('header-title', 'Posts')
@section('header-right')
<div class="toggle-switch">
    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus"
            class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="currentColor"
                d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
            </path>
        </svg>
        New
    </a>
</div>
@endsection
@section('content')
@include('components.alert')
<div class="statbox widget box box-shadow">
    <div class="widget-content widget-content-area">
        <table id="style-1" class="table style-1 dt-table-hover non-hover">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Division</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Dilihat</th>
                    <th class="text-center dt-no-sorting">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td class="user-name">{{ $post->user->name }}</td>
                    <td class="user-name">{{ Str::limit($post->title, 15) }}</td>
                    <td class="user-name">{!! Str::limit($post->body, 15) !!}</td>
                    <td class="user-name">{{ $post->division->name }}</td>
                    <td class="text-center">
                        <span
                            class="badge {{ $post->status ? 'badge-success' : 'badge-info' }}">{{ $post->status ? 'published' : 'pending' }}</span>
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#postview-{{ $post->id }}">
                            <span>{{ count($post->views) }}</span>
                        </a>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="postview-{{ $post->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="postview" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="postview">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="education layout-spacing ">
                                        <div class="widget-content widget-content-area">
                                            <div class="timeline-alter">
                                                @foreach ($post->views as $view)
                                                <div class="item-timeline">
                                                    <div class="t-meta-date w-50">
                                                        <p class="w-100">{{ $view->created_at }}</p>
                                                    </div>
                                                    <div class="t-dot">
                                                    </div>
                                                    <div class="t-text w-50">
                                                        <p>{{ $view->user->name }}</p>
                                                        <p>{{ $view->user->mobile }}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i>
                                        Discard</button>
                                    <button type="button" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <td class="text-center">
                        <div class="btn-group">
                            @if (optional(auth()->user()->division)->name != 'Admin' && $post->status)
                            <a href="javascript:void(0)" style="cursor: not-allowed;" class="btn btn-link">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button style="cursor: not-allowed;" type="button" class="btn btn-link">
                                <i class="fas fa-trash"></i>
                            </button>
                            @else
                            @if (optional(auth()->user()->division)->name == 'Admin' && !$post->status)
                            <form action="{{ route('posts.publish', $post->id) }}" method="POST"
                                onsubmit="return confirm('Anda yakin ingin mem-publish postingan ini?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-link">
                                    <i class="fas fa-share"></i>
                                </button>
                            </form>
                            @else
                            <button type="button" class="btn btn-link" style="cursor: not-allowed;">
                                <i class="fas fa-share"></i>
                            </button>
                            @endif
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-link">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Anda yakin ingin menghapus postingan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
