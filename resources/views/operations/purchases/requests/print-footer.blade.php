
<table style="width:100%; line-height: 3; border: 0px solid rgba(255, 255, 255, 0) !important;">
    <tr style="border: 0px solid rgba(255, 255, 255, 0) !important;">
        <th style="text-align:center; border: 0px solid rgba(255, 255, 255, 0) !important;">
            <div class="caption-left">
            <div class="text-center">
                <br>
                <div class="text-left">
                    <p class="p">ក្រសោមសត្វ ថ្ងៃ............. ខែ............. ឆ្នាំ {{ \Carbon\Carbon::now()->format('Y') }}</p>
                </div>
                <div class="khmer-moul" style="pandding-left:20px;">{{ __('form.casheir') }} </div>
                <br>
                <div class="text-left">
                    <div style="margin-left:100px;" >
                        {{ __('form.name') }} :...............................
                    </div>
                </div>
            </div>
            </div>
        </th>

        <th style="width: 250px; border: 0px solid rgba(255, 255, 255, 0) !important;">

        </th>

        <th style="text-align: center; border: 0px solid rgba(255, 255, 255, 0) !important;">
            <div class="caption-right">
                <div class="text-right">
                <br>
                    <div class="text-left">
                        <p class="p">ក្រសោមសត្វ ថ្ងៃ............. ខែ............. ឆ្នាំ {{ \Carbon\Carbon::now()->format('Y') }}</p>
                    </div>
                    <div class="khmer-moul" style="pandding-left:20px;">ស្នាមមេដៃអ្នកខ្ចី</div>
                    <br>
                    <div class="text-right">
                        <div style="margin-left:100px;" >
                            {{ __('form.name') }} <bold> {{$record->client->name_kh}}</bold>
                        </div>
                    </div>
                </div>
            </div>
        </th>
    </tr>
</table>  