
<div>
    <h3>Dear Mr ...</h3>
    <p>This is the domains list was die</p>
    
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
            <tr>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
        </tbody>
    </table>
</div>
