<li>
    <table>
        <tr>
            <td style="width: 50px; height: 25px">
                @if($organizer->logo)
                    {!! HTML::image('uploads/logos/small/'. $organizer->logo, $organizer->name) !!}
                @endif
            </td>
            <td>
                {!! HTML::linkRoute('veranstalter', $organizer->name, [$organizer->slug]) !!}
            </td>
        </tr>
    </table>
</li>