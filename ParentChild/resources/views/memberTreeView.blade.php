<!DOCTYPE html>
<html>

<head>
    <title>Parent-Child Treeview</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <!-- <script src="//code.jquery.com/jquery.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="/js/jquery-form-validation.js"></script>
    <style>
        .error {
            color: red !important;
        }
    </style>
</head>

<body style="padding: 50px;">

    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Members List</h3>
                        <ul id="tree1">
                            @foreach($members as $member)
                            <li id="member-{{$member->id}}">
                                {{ $member->name }}
                                @if(count($member->childs))
                                @include('manageChild',['childs' => $member->childs])
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>


            </div>

        </div>
    </div>
    <!-- <script src="/js/treeview.js"></script> -->


    <div class="modal fade" id="modalAddMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Add New Member</h4>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </button>
                </div>
                <form id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="mb-2" for="">Choose Parent</label>
                            <select class="form-control " style="width: 100%;" name="parent_name" id="parent_name" required>
                                <option value=""> Select Member</option>
                                @foreach($allMembers as $member)
                                <option value="{{$member->id}}">{{$member->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="childName" class="form-label"> Child Name</label>
                            <input type="text" class="form-control" name="inputChildName" id="inputChildName" placeholder="Add Child Name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-target="#modalAddMember">Add Member</button>

        <!-- <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalAddMember">Add Member</a> -->
    </div>
    <script type="text/javascript">
        //add product
        $('#addForm').on('submit', function(e) {
            e.preventDefault();
            var formData = {
                parent_id: $("#parent_name").val(),
                name: $("#inputChildName").val(),
            };
            $.ajax({
                type: "POST",
                url: "{{ url('addMember') }}",
                data: formData,
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        alert(response.message);
                        location.reload();
                    } else {

                        console.log(response.message);
                    }
                    // to reload
                },
                error: function(error) {
                    console.log(error);
                    // alert("Data not Saved");
                },
            });
        })
        $('#modalAddMember').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');

        });
    </script>


</body>

</html>