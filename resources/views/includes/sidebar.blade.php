<div class="site_title"> 
    
    <div class="flexer up_marg5">
        <div class="twenty_split"> 
            <img src="{{ asset('css/logos/DILG_logo.png') }}" width="50">
        </div>
        <div class="eighty_split side-marg5"> 
            <span>DILG Smart Barangay Management System</span>
        </div>
    </div>  
</div>
@if(Auth::user()->email != Null)
<div class="user_details"> 
    <div class="flexer up_marg5 pad5">
        <div class="twenty_split side-marg3"> 
            <img src="{{ asset('css/profile_photos/'.Auth::user()->name.'_'.Auth::user()->id.'.jpg') }}" width="50" style="border-radius: 50%;">
        </div>
        <div class="eighty_split side-marg5"> 
            <span>{{Auth::user()->name}} &nbsp;&nbsp;</span> 
            <a href="{{route('home')}}" ><i class="fa fa-home" aria-hidden="true"></i></a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form><br>
            <span style="font-size:11px;">{{Auth::user()->email}}</span>
        </div>
    </div>
</div>


<div class="modules">
    <div class="col-sm-12">
        {{-- Transactions / Reports --}}
        <h4 style="text-align:center; border-bottom:1px solid rgb(165, 165, 145);">Transactions/Reports</h4>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BORIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu1">
                <a href=""><li role="presentation">List of Ordinances</li></a>
                <a href=""><li role="presentation">Ordinance Information</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BIPS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">List of Transactions</li></a>
                <a href=""><li role="presentation">Inhabitants Information List</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BCPCIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">List of Transactions</li></a>
                <a href=""><li role="presentation">Document Issuance Transaction</li></a> 
                <a href=""><li role="presentation">Inhabitants Document Request</li></a>
                <a href=""><li role="presentation">Document Payment</li></a>
                <a href=""><li role="presentation">Business Permit Issuance</li></a>
                <a href=""><li role="presentation">Reports Generation</li></a>
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BFAS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Chart of Accounts</li></a>
                <a href=""><li role="presentation">JEV Collection</li></a> 
                <a href=""><li role="presentation">JEV Disbursement</li></a>
                <a href=""><li role="presentation">Budget Appropriation</li></a> 
                <a href=""><li role="presentation">Budget SAAODBA</li></a>
                <a href=""><li role="presentation">Obligation Request</li></a> 
                <a href=""><li role="presentation">Disbursement Voucher</li></a>
                <a href=""><li role="presentation">Check Preparation</li></a> 
                <a href=""><li role="presentation">Check Status Cleared</li></a>
                <a href=""><li role="presentation">Check Status Released</li></a>
                <a href=""><li role="presentation">Payment Collection</li></a>
                <a href=""><li role="presentation">Card File (Supplier)</li></a>  
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BDRIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Disaster Type</li></a>
                <a href=""><li role="presentation">Emergency Evacuation</li></a> 
                <a href=""><li role="presentation">Allocated Fund Source</li></a>
                <a href=""><li role="presentation">Disaster Supplies</li></a>
                <a href=""><li role="presentation">Emergency Team</li></a>
                <a href=""><li role="presentation">Emergency Equipment</li></a>
                <a href=""><li role="presentation">Disaster Related Activities</li></a>
                <a href=""><li role="presentation">Response Information</li></a>
                <a href=""><li role="presentation">Evacuee Information</li></a>
                <a href=""><li role="presentation">Recovery Information</li></a>
                <a href=""><li role="presentation">Affected Household and Infra</li></a>
                <a href=""><li role="presentation">Inhabitants Missing</li></a>
                <a href=""><li role="presentation">Casualties and Injured</li></a>
                <a href=""><li role="presentation">Recovery Damage Loss</li></a>
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BJISBH
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Blotter</li></a>
                <a href=""><li role="presentation">Summons</li></a> 
                <a href=""><li role="presentation">Proceedings</li></a>
                <a href=""><li role="presentation">Ordinance Violators</li></a>
                <a href=""><li role="presentation">Justice Service Rating</li></a>
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Barangay Information</li></a>
                <a href=""><li role="presentation">Barangay Officials and Staff</li></a> 
                <a href=""><li role="presentation">Barangay Officials Term History</li></a>
                <a href=""><li role="presentation">Content Management System</li></a>
                
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BINS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Transaction</li></a>
                <a href=""><li role="presentation">Transaction</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BPMS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">List of Projects</li></a>
            </ul>
        </div>
        
        <br>
        {{-- Maintenance --}}
        <h4 style="text-align:center; border-bottom:1px solid rgb(165, 165, 145);">Maintenance</h4>

        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BORIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu1">
                <a href=""><li role="presentation">Type of Ordinance</li></a>
                <a href=""><li role="presentation">Status of Ordinance</li></a> 
                <a href=""><li role="presentation">Ordinance Category</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BIPS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Blood Type</li></a>
                <a href=""><li role="presentation">Deceased Type</li></a> 
                <a href=""><li role="presentation">Civil Status</li></a>
                <a href=""><li role="presentation">Name Prefix</li></a>
                <a href=""><li role="presentation">Family Position</li></a>
                <a href=""><li role="presentation">Academic Level</li></a>
                <a href=""><li role="presentation">Housing Unit</li></a>
                <a href=""><li role="presentation">Religion</li></a>
                <a href=""><li role="presentation">Family Type</li></a>
                <a href=""><li role="presentation">Employment Type</li></a>
                <a href=""><li role="presentation">Tenure of Lot</li></a>
                <a href=""><li role="presentation">Name Suffix</li></a>
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BCPCIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Barangay Business</li></a>
                <a href=""><li role="presentation">Business Type</li></a> 
                <a href=""><li role="presentation">Document Type</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BFAS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Type of Fee</li></a>
                <a href=""><li role="presentation">Card Type</li></a>
                <a href=""><li role="presentation">Account Type</li></a>
                <a href=""><li role="presentation">Fund Type</li></a>
                <a href=""><li role="presentation">Bank Account</li></a>
                <a href=""><li role="presentation">Voucher Status</li></a>
                <a href=""><li role="presentation">Tax Code</li></a>
                <a href=""><li role="presentation">Tax Type</li></a>
                <a href=""><li role="presentation">Journal Type</li></a>
                <a href=""><li role="presentation">Appropriation Type</li></a>
                <a href=""><li role="presentation">Account Code</li></a>
                <a href=""><li role="presentation">Expenditure Type</li></a>
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BDRIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Alert Level</li></a>
                <a href=""><li role="presentation">Level of Damage</li></a> 
                <a href=""><li role="presentation">Casualty Status</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                PSGC
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Barangay</li></a>
                <a href=""><li role="presentation">City Municipality</li></a> 
                <a href=""><li role="presentation">Province</li></a> 
                <a href=""><li role="presentation">Region</li></a> 
                <a href=""><li role="presentation">Country</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BJISBH
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Case</li></a>
                <a href=""><li role="presentation">Case Type</li></a> 
                <a href=""><li role="presentation">Type of Involved Party</li></a>
                <a href=""><li role="presentation">Violation Status</li></a>
                <a href=""><li role="presentation">Summons Status</li></a>
                <a href=""><li role="presentation">Service Rate</li></a>
                <a href=""><li role="presentation">Proceedings Status</li></a>
                <a href=""><li role="presentation">Type of Action </li></a>
                <a href=""><li role="presentation">Type of Penalties</li></a>
                <a href=""><li role="presentation">Blotter Status</li></a>
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BIS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Term Status</li></a>
                <a href=""><li role="presentation">BIS Categories</li></a> 
                <a href=""><li role="presentation">BIS Frequency</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BINS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href="{{route('bins_uom_maint')}}"><li role="presentation">Unit of Measure</li></a>
                <a href="{{route('bins_bes_maint')}}"><li role="presentation">Borrowed Equipment Status</li></a> 
                <a href="{{route('bins_item_category_maint')}}"><li role="presentation">Item Category</li></a> 
                <a href="{{route('bins_item_class_maint')}}"><li role="presentation">Item Classificiation</li></a> 
                <a href="{{route('bins_item_status_maint')}}"><li role="presentation">Item Status</li></a> 
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BPMS
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href=""><li role="presentation">Project Type</li></a>
                <a href=""><li role="presentation">Accomplishment Status</li></a> 
                <a href=""><li role="presentation">Project Status</li></a>
            </ul>
        </div>
        <div class="module">
            <div class="moduleX" data-toggle="dropdown">
                BRGY WEB
                <i class="fa fa-chevron-down sb_down" aria-hidden="true"></i>
                <i class="fa fa-chevron-up sb_up" aria-hidden="true"></i>
            </div>
            <ul class="sub_module" role="menu" aria-labelledby="menu2">
                <a href="{{route('bweb_ann_status_maint')}}"><li role="presentation">Announcement Status</li></a>
                <a href="{{route('bweb_ann_type_maint')}}"><li role="presentation">Announcement Type</li></a>
                <a href="{{route('bweb_news_status_maint')}}"><li role="presentation">News Status</li></a> 
                <a href="{{route('bweb_news_type_maint')}}"><li role="presentation">News Type</li></a>
            </ul>
        </div>

    </div>
</div>
@endif
