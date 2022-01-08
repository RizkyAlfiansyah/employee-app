@extends('app')

@section('title', 'Home')

@section('content')

<div class="row justify-content-center">
    <div class="col-4">
        <div class="row" style="color: aliceblue; background-color: #0C325F;">
            <div class="col">
                <h3 class="text-center py-3 col-12 fw-light fs-5" >Data Pegawai</h3>
            </div>
        </div>
        <div class="row justify-content-center bg-light mb-3">
            @if (session()->has('login'))
            <div class="justify-content-center pt-2">
                <div class="alert alert-success alert-dismissible fade show justify-content-center px-4 pt-2" role="alert">
                   {{ session('login') }} {{ auth()->user()->name }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            <div class="col-12">                                
                <div class="row justify-content-center">
                    <div class="col-12">
                        {{-- @auth --}}
                        <button type="button" class="btn btn-info p-2 shadow rounded-3 col-5 my-2 " style="color:aliceblue; background-color: #30AEE4;" onClick="create()" >Tambah Pegawai</button>
                        {{-- <form action="/logout" method="POST">
                        @csrf
                            <button type="submit" class="btn btn-info p-3 shadow rounded-3 col-12 my-2 " style="color:aliceblue; background-color: #30AEE4;">Logout   
                            </button>
                        </form>
                        @else
                        <form action="#" method="get">
                            <button type="submit" class="btn btn-info p-3 shadow rounded-3 col-5 my-2 " style="color:aliceblue; background-color: #30AEE4;">Tambah Pegawai</div>
                        </form>
                        @endauth --}}
                    
                </div>
            </div>
            <div id="fetch-data">
                <div class="row justify-content-center my-2">
                    <div class="col lg-4">
                        <table class="table mx-2">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Gaji</th>
                              </tr>
                            </thead>
                            <tbody id="fetch">

                            </tbody>  
                        </table>
                    </div>
                </div>
            </div>
            
           
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Input Sampah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addPost">
                @csrf
                <div class="form-group my-2">
                        <input oninput="this.value = this.value.toUpperCase()" type="text" class="form-control" id="name" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control"  id="salary" placeholder="Gaji" required></input>
                    </div>
        
                    <input type="submit" class="btn btn-warning my-2" value="Tambah Data">
                </div>
            </form>
        </div>
    </div>
    </div>
</div> 

<script>
    $(document).ready(function() {
    getPosts();
});

    document.getElementById('addPost').addEventListener('submit', addPost);

    function getPosts() {
			fetch('http://127.0.0.1:8000/api/pegawai')
			.then((res) => res.json())
			.then((data) => {
                if(data.length == 0)
                {
                    let output = `<tr class="col-sm-2"> Data Not Found </tr>`
                    document.getElementById('fetch').innerHTML = output;

                }else{
                    let output = '';
                    // console.log(data);
                    let no = 1;
                    data.forEach((post) => {
                        output += `
                        <tr>        
                            <th scope="row">${no++}</th>
                                        <td>${post.name}</td>
                                        <td>${post.salary}</td>
                        </tr>
                        `;
                    });
                    document.getElementById('fetch').innerHTML = output;
                }
			})
		}
    
    // Create Modal
    function create() {
        $("#addModal").modal('show');
        $("#exampleModalLabel").html('Input Pegawai Baru');
    }

    function addPost(e) {
			e.preventDefault();
				var name = document.getElementById('name').value;
				let salary = document.getElementById('salary').value;

				fetch('http://127.0.0.1:8000/api/pegawai', {
					method: 'POST',
					headers: {
						'Accept': 'application/json, text/plain, */*',
						'Content-type':'application/json'
					},
					body:JSON.stringify({name:name, salary:salary})
				})
                
                // .then((res) => res.json())
                // .then((data) => console.log(data))
                // $(".btn-close").click();
                // getPosts();
                // create();

                .then(response => response.json())
                .then(data => {
                    if(data == true){
                        console.log('Success:', data);
                        alert('Data Berhasil Di Input', 'success');
                        document.getElementById('name').value='';
                        document.getElementById('salary').value='';
                        getPosts();
                        $(".btn-close").click();
                    } else{
                        alert('Data Gagal di Input');
                    }
                    
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
                        
		}

</script>

@endsection
{{-- 
@push('script')

<script src="{{ asset('/js/main.js') }}"></script>

@endpush --}}