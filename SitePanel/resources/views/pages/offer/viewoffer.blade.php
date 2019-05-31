<div class="viewitems-main-container">
    <div class="viewitems-main-heading">View Offer</div>
    <hr>
    <div id="alert-success" class="alert alert-success alert-dismissible fade show alert-success-message">
        <a href="#" class="close" aria-label="close">&times;</a>
        <strong id="alert-success-message-area"></strong>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Store Title</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->store->title }}" readonly/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Category Title</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->category->title }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer Title</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->title }}" readonly/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer Anchor</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->anchor }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-field">
                <div class="form-field-heading">Offer Location</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->location }}" readonly/>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-field">
                <div class="form-field-heading">Offer Type</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->type }}" readonly/>
            </div>
        </div>
        @if($offer->code != null)
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer Code</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->code }}" readonly/>
            </div>
        </div>
        @else
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer Code</div>
                <input type="text" class="form-control form-field-text not-required-yet" value="Not Required" readonly/>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field">
                <div class="form-field-heading">Offer Created At</div>
                <textarea class="form-control form-field-textarea" readonly>{{$offer->details}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-field">
                <div class="form-field-heading">Offer Starting Date</div>
                <input type="text" class="form-control form-field-text" value="{{Carbon\Carbon::parse($offer->starting_date)->format('d-m-Y')}}" readonly>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-field">
                <div class="form-field-heading">Offer Expiry Date</div>
                @if($offer->expiry_date != null)
                <input type="text" class="form-control form-field-text" value="{{ \Carbon\Carbon::parse($offer->expiry_date)->format('d-m-Y') }}" readonly/>
                @else
                <input type="text" class="form-control form-field-text not-required-yet" value="Soon" readonly/>
                @endif
            </div>
        </div>
        @if($offer->starting_date <= config('constants.TODAY_DATE') && ($offer->expiry_date >= config('constants.TODAY_DATE') || $offer->expiry_date == null))
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer life Remark</div>
                <input type="text" class="form-control form-field-text available-offer" value="Available" readonly>
            </div>
        </div>
        @elseif($offer->starting_date > config('constants.TODAY_DATE'))
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer life Remark</div>
                <input type="text" class="form-control form-field-text pending-offer" value="Pending" readonly>
            </div>
        </div>
        @elseif($offer->expiry_date < config('constants.TODAY_DATE'))
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer life Remark</div>
                <input type="text" class="form-control form-field-text expired-offer" value="Expired" readonly>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-2">
            <div class="form-field">
                <div class="form-field-heading">Is Popular Offer</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->is_popular }}" readonly/>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-field">
                <div class="form-field-heading">Display At Home</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->display_at_home }}" readonly/>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-field">
                <div class="form-field-heading">Is Verified Offer</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->is_verified }}" readonly/>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-field">
                <div class="form-field-heading">Offer Status</div>
                @if($offer->is_active == "y")
                <input type="text" class="form-control form-field-text active-item" value="_active" readonly/>
                @else
                <input type="text" class="form-control form-field-text deactive-item" value="deactive" readonly/>
                @endif
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-field">
                <div class="form-field-heading">Offer Added/Updated By</div>
                <input type="text" class="form-control form-field-text" value="{{ $offer->user->username }}" readonly/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer Created At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($offer->created_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
        @if($offer->updated_at != null)
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer Updated At</div>
                <input type="text" class="form-control form-field-text" value="{{ Carbon\Carbon::parse($offer->updated_at)->format('d-m-Y  h:i:s A') }}" readonly/>
            </div>
        </div>
        @else
        <div class="col-sm-6">
            <div class="form-field">
                <div class="form-field-heading">Offer Updated At</div>
                <input type="text" class="form-control form-field-text not-required-yet" value="Not Yet" readonly/>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-field" id="viewoffer-action-buttons">
                <a href="{{Session::get('url')}}" id="backtooffers" class="btn btn-success form-button"><i class="fa fa-backward"></i>Back To Offers</a>
                <a href="/updateoffer/{{$offer->id}}" class="btn btn-primary form-button" id="updateoffer">Update Offer<i class="fa fa-forward"></i></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        if('{{Session::has("updateoffer_successmessage")}}'){
            $("#alert-success-message-area").html('{{Session::get("updateoffer_successmessage")}}');
            $("#alert-success").fadeTo(1000, 500).slideUp(500, function(){
                $("#alert-success").slideUp(500);
            });
        }
        $("#viewoffer-action-buttons a").click(function(event){
            event.preventDefault();
            $("#panel-body-container").load($(this).attr("href"));
        });
    });
</script>