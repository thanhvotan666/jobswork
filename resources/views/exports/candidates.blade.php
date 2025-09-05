<table>
    <thead>
        <tr>
            <th>{{ __('name') }}</th>
            <th>{{ __('job applied name')}}</th>
            <th>{{ __('sex') }}</th>
            <th>{{ __('date of Birth') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('phone') }}</th>
            <th>{{ __('introduce') }}</th>
            <th>{{ __('position') }}</th>
            <th>{{ __('desired location') }}</th>
            <th>{{ __('address') }}</th>
            <th>{{ __('education') }}</th>
            <th>{{ __('status') }}</th>
            <th>{{ __('time') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($applieds as $applied)
            <tr>
                <td>{{ $applied->user->name }}</td>
                <td>{{ __($applied->user->sex) }}</td>
                <td>{{ $applied->user->date_of_birth }}</td>
                <td>{{ $applied->show_contact ? $applied->user->email : __('contact not activated')}}</td>
                <td>{{ $applied->show_contact ? $applied->user->phone : __('contact not activated')}}</td>
                <td>{{ $applied->user->introduce }}</td>
                <td>{{ $applied->user->position }}</td>
                <td>{{ $applied->user->desired_location }}</td>
                <td>{{ $applied->user->address }}</td>
                <td>
                    {{-- {{ 
                    //$applied->user->educations->pluck('education') 
                    }} --}}
                </td>
                <td>{{ __($applied->status) }}</td>
                <td>{{ $applied->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>