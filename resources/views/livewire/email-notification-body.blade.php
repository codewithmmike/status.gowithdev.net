<div>
    <h3>Dear Mr/Mrs {{ $user->name }}</h3>
    <h4>Notice: this is the domains list was die. Please check</h4>
    <table id="domain" class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($listdomain as $domain)
                <tr>
                    <td>{{ $domain->name }}</td>
                    <td>{{ $domain->status }}</td>
                    <td>{{ $domain->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
