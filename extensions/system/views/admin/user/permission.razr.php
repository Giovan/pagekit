@style('user', 'system/css/user.css')
@script('user', 'system/js/user/permission.js', ['requirejs'])

<form id="js-permission" class="uk-form" action="@url.route('@system/permission/save')" method="post">

    <div class="uk-overflow-container">

        <table class="uk-table uk-table-hover uk-table-middle pk-table-subheading pk-table-indent uk-margin-remove">
            <thead>
                <tr>
                    <th class="pk-table-min-width-200">@trans('Permission')</th>
                    @foreach (roles as role)
                    <th class="pk-table-width-100 pk-table-max-width-100 uk-text-truncate uk-text-center">@role.name</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach (app.permissions as extension => permission)
                <tr id="ext-@extension">
                    <th class="pk-table-min-width-200">@app.extensions.repository.findPackage(extension).title</th>
                    @foreach (roles as role)
                    <th class="pk-table-width-100 pk-table-min-width-100"></th>
                    @endforeach
                </tr>
                    @foreach (permission as name => data)
                    <tr>
                        <td class="pk-table-text-break">
                            @trans(data.title)
                            @if (data.description)
                            <small class="uk-text-muted uk-display-block">@trans(data.description)</small>
                            @endif
                        </td>
                        @foreach (roles as role)
                        <td class="uk-text-center">
                            @if (role.administrator)
                            <input type="checkbox" checked disabled>
                            @else
                            <input class="@( !role.locked ? 'pk-checkbox' )" type="checkbox" name="permissions[@role.id][]" value="@name"@( role.hasPermission(name) ? ' checked' )>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

    </div>

    @token()

</form>