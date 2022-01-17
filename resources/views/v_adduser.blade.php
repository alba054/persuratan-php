<div class="modal fade" id="sama">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">sasas</h4>
            </div>

            <form id="FormUser" action="{{ route('user_insert') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">
                    <div class="form-group has-feedback">
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">               
                    </div>
                
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">                   
                    </div>
                
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" id="password1" placeholder="Password">               
                    </div>
                
                    <div class="form-group has-feedback">
                        <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirm Password">                    
                    </div>
            
                    <div class="form-group has-feedback">
                        <select name="level_id" class="form-control">
                            <option value="4">Admin</option>
                            <option value="2">Kepala Desa</option>
                            <option value="1">Kurir</option>
                        </select>              
                    </div>   
                </div>

                <div class="modal-footer">
                    <a type="button" class="btn btn-danger pull-right" data-dismiss="modal">Tutup</a>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-sm pull-left">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



