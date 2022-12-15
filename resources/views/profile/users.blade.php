<x-app-layout>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
			<div class="table-responsive">
				<table class="table user-list">
					<thead>
						<tr>
							<th><span>User</span></th>
							<th><span>Created</span></th>
							<th class="text-center"><span>Status</span></th>
							<th><span>Email</span></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                    @foreach ($users as $user)

						<tr>
							<td>
								<img src="{{$user->img}}" alt="">
								<a href="#" class="user-link">{{$user->name}}</a>
							</td>
							<td>
								{{$user->created_at}}
							</td>
							<td class="text-center">
								<span class="label label-default">Inactive</span>
							</td>
							<td>
								<a href="#">{{$user->email}}</a>
							</td>
							<td style="width: 20%;">
								<a href="#" class="table-link">
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
									</span>
								</a>
								<a href="#" class="table-link">
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
									</span>
								</a>
								<a href="#" class="table-link danger">
									<span class="fa-stack">
										<i class="fa fa-square fa-stack-2x"></i>
										<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
									</span>
								</a>
							</td>
						</tr>
                        @endforeach

					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>
</div>
</x-app-layout>
