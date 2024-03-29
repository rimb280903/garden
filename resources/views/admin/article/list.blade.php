@extends('admin.layouts.app')

@section('content')


				<section class="content-header">
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Blogs</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('admin.article.create')}}" class="btn btn-primary">New Article</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="card">
                        <form action="{{ route('admin.blogs') }}" method="GET">
    <div class="card-header">
        <div class="card-tools">
            <div class="input-group input-group" style="width: 250px;">
                <input type="text" name="q" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


							</div>
							<div class="card-body table-responsive p-0">
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th width="200">Name</th>
                                            <th>Date d'ajout</th>
                                            <th>Date de modification</th>
											<th width="100">Action</th>
										</tr>
									</thead>
									<tbody>
                                        @if($articles->isNotEmpty())
										@foreach($articles as $article)
										<tr>
											<td>{{ $article->id}}</td>

											<td>{{$article->title}}</td>
                                            <td>{{$article->created_at}}</td>
                                            <td>{{$article->updated_at}}</td>



                                            <td>
                                            <a href="{{ route('admin.article.show', $article->id) }}">
                                            <svg  class="filament-link-icon w-4 h-4 mr-1"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" id="read"><path d="M16.068,4.063a12.463,12.463,0,0,0-5.265.769,2.216,2.216,0,0,0-.8.682,2.209,2.209,0,0,0-.8-.682,12.51,12.51,0,0,0-5.265-.769,1.494,1.494,0,0,0-1.444,1.5v7.962a1.488,1.488,0,0,0,1.47,1.5c1.255.021,4.335.15,5.824.875A.491.491,0,0,0,10,15.95a.485.485,0,0,0,.219-.051c1.489-.725,4.569-.854,5.824-.875a1.488,1.488,0,0,0,1.47-1.5V5.562A1.494,1.494,0,0,0,16.068,4.063ZM3.487,13.524V5.562a.5.5,0,0,1,.48-.5,11.589,11.589,0,0,1,4.8.673A1.332,1.332,0,0,1,9.5,6.948v7.771a21.426,21.426,0,0,0-5.525-.7A.494.494,0,0,1,3.487,13.524Zm13.026,0a.494.494,0,0,1-.488.5,21.508,21.508,0,0,0-5.525.692V6.948a1.333,1.333,0,0,1,.731-1.213,10.423,10.423,0,0,1,4.118-.685c.252,0,.483,0,.683.012a.5.5,0,0,1,.481.5Z"></path></svg>
</a>


    <a href="{{ route('admin.article.edit', $article->id) }}">
        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
        </svg>
    </a>

    <a href="{{ route('admin.article.destroy', $article->id) }}"
        onclick="confirmDelete(event, '{{ $article->id }}')"
        class="text-danger w-4 h-4 mr-1">
        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
    </a>

    <!-- Form for deletion -->
    <form id="delete-form-{{ $article->id }}" action="{{ route('admin.article.destroy', $article->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</td>

										</tr>

										@endforeach
                                        @else
                                        <p>No articles found!</p>
                                        @endif

									</tbody>
								</table>
							</div>
							<div class="card-footer clearfix">
							</div>
						</div>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>
@endsection
@section('customJs')
<script>
    function confirmDelete(event, articleId) {
        event.preventDefault();

        if (confirm('Are you sure you want to delete this article?')) {
            // Si l'utilisateur confirme, soumettez le formulaire de suppression
            document.getElementById('delete-form-' + articleId).submit();
        }
    }
</script>
@endsection

