@include("header")
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="/MyWork/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/MyWork/DataTables/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="/MyWork/node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <!--Edit-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labeledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Accounts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Account:</label>
                    <input name="editAccount"></input>
                    <br>
                    <label>Name:</label>
                    <input name="editName"></input>
                    <br>
                    <label>Gender:</label>
                    <input name="editGender"></input>
                    <br>
                    <label>Birthday:</label>
                    <input name="editBirth"></input>
                    <br>
                    <label>Email:</label>
                    <input name="editName"></input>
                    <br>
                    <label>PS:</label>
                    <input name="editPs"></input>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Add-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labeledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Accounts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form data-action="{{ route('accounts.store') }}" method="POST" enctype="multipart/form-data" id="add-account">
                    <div class="modal-body">
                        <label>Account:</label>
                        <input name="account">
                        <br>
                        <label>Name:</label>
                        <input name="name"></input>
                        <br>
                        <label>Gender:</label>
                        <input name="gender"></input>
                        <br>
                        <label>Birthday:</label>
                        <input name="birthday"></input>
                        <br>
                        <label>Email:</label>
                        <input name="email"></input>
                        <br>
                        <label>PS:</label>
                        <input name="ps"></input>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Your accounts
            </div>
            <div id="message"></div>
            <div><button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add</button></div>
            <div>
            <table class="dataTable table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Account</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Email</th>
                        <th scope="col">PS</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr scope="row">
                        <td>{{$account->id}}</td>
                        <td>{{$account->account}}</td>
                        <td>{{$account->name}}</td>
                        <td>{{$account->gender}}</td>
                        <td>{{$account->birthday}}</td>
                        <td>{{$account->email}}</td>
                        <td>{{$account->PS}}</td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
         </div>
    </div>
</body>

<!--JQUERY-->
<script src="/MyWork/node_modules/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/MyWork/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="/MyWork/DataTables/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="/MyWork/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    var form = "#add-account";
    $(form).on('submit', function(event){
        event.preventDefault();
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: $(this).attr('data-action'),
            method: 'POST',
            dataType: 'JSON',
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function(response) {
                console.log(response.message);
                $("#message").html("新增成功");
                $("#addModal").modal('hide');
            },
            error: function(response) {
                console.log(response.message);
                $("#message").html("新增失敗");
                $("#addModal").modal('hide');
            }
        });
    });
});
</script>

@include("footer")
