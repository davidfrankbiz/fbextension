@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="col-xs-6">
                    <h3 class="box-title" style="font-size: 40px !important;">Sms Templates</h3>
                    </div>
                    <div class="col-xs-6 text-right">
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                data-target="#myModal1">New Template
                        </button>
                    </div>

                </div>
                <div class="box-body ex1">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Deleted</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($templates))
                            @foreach($templates as $template)
                                <tr class="templateRow">
                                    <td class="editTemplateId">{{$template->id}}</td>
                                    <td class="editTemplateTitle">{{$template->title}}</td>
                                    <td class="editTemplateBody">{{$template->body}}</td>
                                    <td class="editTemplateStatus">{{$template->status}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-lg editTemplateButton" data-toggle="modal"
                                                data-target="#myModal2">Edit</button>
                                    </td>
                                    <td>
                                        <form action="{{route('templatesSMS')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="template_id" value="{{$template->id}}">
                                            <input type="hidden" name="_method" value="delete">
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>No Data Found</tr>
                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Templates</h4>
                    </div>
                    <div class="modal-body fblogs">

                        <form action="/templates" id="addTemplates">
                            @csrf

                            <div class="form-group">
                                <label for="templatesTitle">Title</label>
                                <input name="templatesTitle" type="text" class="form-control" id="templatesTitle" placeholder="Title">
                                <div id="addTemplatesTitleError"></div>
                            </div>

                            <div class="form-group">
                                <label for="templatesBody">Body</label>
                                <textarea name="templatesBody" class="form-control" id="templatesBody" rows="3"></textarea>
                                <div id="addTemplatesBodyError"></div>
                            </div>

                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="addWelcomeMessage">
                                <label class="custom-control-label" for="addWelcomeMessage">Welcome Message</label>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" id="addTemplatesSave">Save</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="container">

        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Template</h4>
                    </div>
                    <div class="modal-body fblogs">

                        <form action="/templates" id="editTemplates">
                            <input type="hidden" id="editTemplatesId" value="" name="editTemplatesId">

                            <div class="form-group">
                                <label for="editTemplatesTitle">Title</label>
                                <input name="editTemplatesTitle" type="text" class="form-control" id="editTemplatesTitle" placeholder="Title">
                                <div id="editTemplatesTitleError"></div>
                            </div>

                            <div class="form-group">
                                <label for="editTemplatesBody">Body</label>
                                <textarea name="editTemplatesBody" class="form-control" id="editTemplatesBody" rows="3"></textarea>
                                <div id="editTemplatesBodyError"></div>
                            </div>

                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" id="editWelcomeMessage">
                                <label class="custom-control-label" for="editWelcomeMessage">Welcome Message</label>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" id="editTemplatesSave">Save</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
@section('javascript')
    <script type="text/javascript">

        $(document).ready(function () {
            $('#addTemplatesSave').click(function () {
                $.ajax({
                    url: $('#addTemplates').attr('action'),
                    method: 'PUT',
                    data: {
                        _token: $('[name=_token]').val(),
                        title: $('[name=templatesTitle]').val(),
                        body: $('[name=templatesBody]').val(),
                        status: $('#addWelcomeMessage').prop('checked')
                    },
                    success: function (data) {
                        if (data.status == 'Successful') {
                            location.reload()
                        }

                        if (data.title){
                            $('#addTemplatesTitleError').html(`<div  class="alert alert-danger">`+data.title[0]+`</div>`)
                        }
                        if (data.body){
                            $('#addTemplatesTitleError').html(`<div  class="alert alert-danger">`+data.body[0]+`</div>`)
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
            })

            $('.editTemplateButton').click(function () {
                $('#editTemplatesTitle').val('')
                $('#editTemplatesBody').val('')
                $('#editTemplatesId').val('')
                $('#editWelcomeMessage').removeAttr('checked')
                $('#editTemplatesTitle').val($(this).parents('.templateRow').children('.editTemplateTitle').html())
                $('#editTemplatesBody').val($(this).parents('.templateRow').children('.editTemplateBody').html())
                $('#editTemplatesId').val($(this).parents('.templateRow').children('.editTemplateId').html())
                if ($(this).parents('.templateRow').children('.editTemplateStatus').html()=='welcome') {
                    $('#editWelcomeMessage').attr('checked','checked')
                }
            })

            $('#editTemplatesSave').click(function () {
                $.ajax({
                    url: $('#addTemplates').attr('action'),
                    method: 'POST',
                    data: {
                        _token: $('[name=_token]').val(),
                        id: $('[name=editTemplatesId]').val(),
                        title: $('[name=editTemplatesTitle]').val(),
                        body: $('[name=editTemplatesBody]').val()
                    },
                    success: function (data) {
                        console.log(data)
                        if (data.status == 'Successful') {
                            location.reload()
                        }
                        if (data.title){
                            $('#editTemplatesTitleError').html(`<div  class="alert alert-danger">`+data.title[0]+`</div>`)
                        }
                        if (data.body){
                            $('#editTemplatesTitleError').html(`<div  class="alert alert-danger">`+data.body[0]+`</div>`)
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                })
            })
        })

    </script>
@endsection