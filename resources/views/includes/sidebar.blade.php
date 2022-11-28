<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('css/logos/DILG_logo.png') }}" alt="DLIG BMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DILG BMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                @if (Auth::user()->User_Type_ID == 1 || Auth::user()->User_Type_ID == 3)
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header" style="font-size: 20px;">Transactions</li>
                <li class="nav-item">
                    <a href="#" class="nav-link" title="Barangay Ordinance And Resolution">
                        <img src="{{ asset('css/logos/Ordinance &Resolution.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Ordinance & Resolution
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('ordinances_and_resolutions_list')}}" class="nav-link">
                                <p>Ordinance Information</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('resolutions_list')}}" class="nav-link">
                                <p>Resolution Information</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/Inhabitants.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Inhabitants
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('inhabitants_information_list')}}" class="nav-link">
                                <p>Inhabitants List</p>
                            </a>
                            <a href="{{route('inhabitants_household_profile')}}" class="nav-link">
                                <p>Household Profile</p>
                            </a>
                            <a href="{{route('deceased_profile_list')}}" class="nav-link">
                                <p>Deceased Profile</p>
                            </a>
                            @if (Auth::user()->User_Type_ID == 1)
                            <a href="{{route('inhabitants_transfer_list')}}" class="nav-link">
                                <p>Inhabitants Transfer</p>
                            </a>
                            <a href="{{route('inhabitants_incoming_list')}}" class="nav-link">
                                <p>Incoming List</p>
                            </a>
                            <a href="{{route('application_list')}}" class="nav-link">
                                <p>Application List</p>
                            </a>
                            <a href="{{route('brgy_official_list')}}" class="nav-link">
                                <p>Brgy. Official</p>
                            </a>
                            <a href="{{route('brgy_purok_leader_list')}}" class="nav-link">
                                <p>Brgy. Purok Leader</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/Certification & Permits.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Certification & Permits
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <!-- <a href="" class="nav-link">
                                <p>Document Issuance Transaction</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Inhabitants Document Request</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Document Payment</p>
                            </a> -->
                            <a href="{{route('brgy_business_permit_list')}}" class="nav-link">
                                <p>Business Permit</p>
                            </a>
                            <!-- <a href="" class="nav-link">
                                <p>Reports Generation</p>
                            </a> -->
                            <a href="{{route('brgy_document_information_list')}}" class="nav-link">
                                <p>Brgy Document Information</p>
                            </a>
                            <a href="{{route('barangay_business_list')}}" class="nav-link">
                                <p>Barangay Business</p>
                            </a>
                            <!-- <a href="{{route('brgy_document_claim_business_list')}}" class="nav-link">
                                <p>Brgy Document Claim(Business Permit)</p>
                            </a> -->
                            @if (Auth::user()->User_Type_ID == 1)
                            <a href="{{route('document_request_pending_list')}}" class="nav-link">
                                <p>Document Request Pending</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/Accounting.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Accounting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bfas_accounts_information')}}" class="nav-link">
                                <p>Chart of Accounts</p>
                            </a>
                            <a href="{{route('bfas_jev_collection')}}" class="nav-link">
                                <p>JEV Collection</p>
                            </a>
                            <a href="{{route('bfas_jev_disbursement')}}" class="nav-link">
                                <p>JEV Disbursement</p>
                            </a>
                            <a href="{{route('bfas_budget_appropriation')}}" class="nav-link">
                                <p>Budget Appropriation</p>
                            </a>
                            <a href="bfas_SAAODBA" class="nav-link">
                                <p>Budget SAAODBA</p>
                            </a>
                            <a href="{{route('bfas_obligation_request')}}" class="nav-link">
                                <p>Obligation Request</p>
                            </a>
                            <a href="{{route('bfas_disbursement_voucher')}}" class="nav-link">
                                <p>Disbursement Voucher</p>
                            </a>
                            <a href="{{route('bfas_check_preparation')}}" class="nav-link">
                                <p>Check Preparation</p>
                            </a>
                            <a href="{{route('bfas_check_status')}}" class="nav-link">
                                <p>Check Status Cleared</p>
                            </a>
                            <a href="{{route('bfas_check_status_released')}}" class="nav-link">
                                <p>Check Status Released</p>
                            </a>
                            <a href="{{route('bfas_payment_collection')}}" class="nav-link">
                                <p>Payment Collection</p>
                            </a>
                            <a href="{{route('bfas_card_file')}}" class="nav-link">
                                <p>Card File (Supplier)</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/Disaster Response.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Disaster Response
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('other_transaction_list')}}" class="nav-link">
                                <p>Other Transaction/s</p>
                            </a>
                            <!-- <a href="{{route('disaster_type_list')}}" class="nav-link">
                                <p>Disaster Type</p>
                            </a>
                            <a href="{{route('emergency_evacuation_site_list')}}" class="nav-link">
                                <p>Emergency Evacuation Site</p>
                            </a>
                            <a href="{{route('allocated_fund_source_list')}}" class="nav-link">
                                <p>Allocated Fund Source</p>
                            </a>
                            <a href="{{route('disaster_supplies_list')}}" class="nav-link">
                                <p>Disaster Supplies</p>
                            </a>
                            <a href="{{route('emergency_team_list')}}" class="nav-link">
                                <p>Emergency Team</p>
                            </a>
                            <a href="{{route('emergency_equipment_list')}}" class="nav-link">
                                <p>Emergency Equipment</p>
                            </a> -->
                            <a href="{{route('disaster_related_activities_list')}}" class="nav-link">
                                <p>Disaster Related Activities</p>
                            </a>
                            <a href="{{route('response_information_list')}}" class="nav-link">
                                <p>Response Information</p>
                            </a>
                            <!-- <a href="" class="nav-link">
                                <p>Evacuee Information</p>
                            </a> -->
                            <a href="{{route('recovery_information_list')}}" class="nav-link">
                                <p>Recovery Information</p>
                            </a>
                            <!-- <a href="" class="nav-link">
                                <p>Affected Household and Infra</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Inhabitants Missing</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Casualties and Injured</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Recovery Damage Loss</p>
                            </a> -->
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" title="Barangay Justice, Blotter and Help Desk Information System">
                        <img src="{{ asset('css/logos/Justice.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Justice
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('blotter_list')}}" class="nav-link">
                                <p>Blotter</p>
                            </a>
                            <a href="{{route('summon_list')}}" class="nav-link">
                                <p>Summons</p>
                            </a>
                            <a href="{{route('proceeding_list')}}" class="nav-link">
                                <p>Proceedings</p>
                            </a>
                            <a href="{{route('ordinance_violator_list')}}" class="nav-link">
                                <p>Ordinance Violators</p>
                            </a>
                            <a href="{{route('justice_rating_staff')}}" class="nav-link">
                                <p>Justice Rating</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/Inventory.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bins_begbal')}}" class="nav-link">
                                <p>Inventory Beginning Balance</p>
                            </a>
                            <a href="{{route('bins_inventory')}}" class="nav-link">
                                <p>Barangay Inventory</p>
                            </a>
                            <a href="{{route('bins_item_inspection')}}" class="nav-link">
                                <p>Item for Inspection</p>
                            </a>
                            <a href="{{route('bins_received_item')}}" class="nav-link">
                                <p>Received Item</p>
                            </a>
                            <a href="{{route('bins_physical_count')}}" class="nav-link">
                                <p>Physical Count</p>
                            </a>
                            <a href="{{route('bins_inv_disposal')}}" class="nav-link">
                                <p>Inventory for Disposal</p>
                            </a>
                            <a href="{{route('bins_borrow')}}" class="nav-link">
                                <p>Equipment Borrow Request</p>
                            </a>
                            <a href="{{route('bins_supply_issuance')}}" class="nav-link">
                                <p>Supplies Issuance</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/Projects.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Projects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('contractor_list')}}" class="nav-link">
                                <p>Contractor</p>
                            </a>
                            <a href="{{route('brgy_projects_monitoring_list')}}" class="nav-link">
                                <p>Brgy Projects Monitoring</p>
                            </a>

                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/BIS.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            BIS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <!-- <a href="" class="nav-link">
                                <p>Barangay Information</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Barangay Officials and Staff</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Barangay Officials Term History</p>
                            </a> -->
                            <a href="{{route('cms_list')}}" class="nav-link">
                                <p>Content Management System</p>
                            </a>

                        </li>
                    </ul>
                </li>
                @elseif (Auth::user()->User_Type_ID == 5)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clone"></i>
                        <p>
                            BIS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <!-- <a href="" class="nav-link">
                                <p>Barangay Information</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Barangay Officials and Staff</p>
                            </a>
                            <a href="" class="nav-link">
                                <p>Barangay Officials Term History</p>
                            </a> -->
                            <a href="{{route('cms_list')}}" class="nav-link">
                                <p>Content Management System</p>
                            </a>

                        </li>
                    </ul>
                </li>
                <li class="nav-header" style="font-size: 20px;">Maintenance</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <img src="{{ asset('css/logos/Ordinance &Resolution.png') }}" style="opacity: .8; margin-right:5px" height="35" width="35">
                        <p>Ordinance & Resolution</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('type_of_ordinance_maint')}}" class="nav-link">
                                <p>Type of Ordinance</p>
                            </a>
                            <a href="{{route('status_of_ordinance_maint')}}" class="nav-link">
                                <p>Status of Ordinance</p>
                            </a>
                            <a href="{{route('ordinance_category_maint')}}" class="nav-link">
                                <p>Ordinance Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BIPS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('blood_type_maint')}}" class="nav-link">
                                <p>Blood Type</p>
                            </a>
                            <a href="{{route('deceased_type_maint')}}" class="nav-link">
                                <p>Deceased Type</p>
                            </a>
                            <a href="{{route('civil_status_maint')}}" class="nav-link">
                                <p>Civil Status</p>
                            </a>
                            <a href="{{route('name_prefix_maint')}}" class="nav-link">
                                <p>Name Prefix</p>
                            </a>
                            <a href="{{route('family_position_maint')}}" class="nav-link">
                                <p>Family Position</p>
                            </a>
                            <a href="{{route('academic_level_maint')}}" class="nav-link">
                                <p>Academic Level</p>
                            </a>
                            <a href="{{route('housing_unit_maint')}}" class="nav-link">
                                <p>Housing Unit</p>
                            </a>
                            <a href="{{route('religion_maint')}}" class="nav-link">
                                <p>Religion</p>
                            </a>
                            <a href="{{route('family_type_maint')}}" class="nav-link">
                                <p>Family Type</p>
                            </a>
                            <a href="{{route('employment_type_maint')}}" class="nav-link">
                                <p>Employment Type</p>
                            </a>
                            <a href="{{route('tenure_of_lot_maint')}}" class="nav-link">
                                <p>Tenure of Lot</p>
                            </a>
                            <a href="{{route('name_suffix_maint')}}" class="nav-link">
                                <p>Name Suffix</p>
                            </a>
                            <a href="{{route('brgy_position_maint')}}" class="nav-link">
                                <p>Brgy. Position</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BCPCIS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('purpose_document_list')}}" class="nav-link">
                                <p>Purpose of Document</p>
                            </a>
                            <a href="{{route('business_type_list')}}" class="nav-link">
                                <p>Business Type</p>
                            </a>
                            <a href="{{route('document_type_list')}}" class="nav-link">
                                <p>Document Type</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BFAS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bfas_type_of_fee_maint')}}" class="nav-link">
                                <p>Type of Fee</p>
                            </a>
                            <a href="{{route('bfas_card_type_maint')}}" class="nav-link">
                                <p>Card Type</p>
                            </a>
                            <a href="{{route('bfas_account_type_maint')}}" class="nav-link">
                                <p>Account Type</p>
                            </a>
                            <a href="{{route('bfas_fund_type_maint')}}" class="nav-link">
                                <p>Fund Type</p>
                            </a>
                            <a href="{{route('bfas_bank_account_maint')}}" class="nav-link">
                                <p>Bank Account</p>
                            </a>
                            <a href="{{route('bfas_voucher_status_maint')}}" class="nav-link">
                                <p>Voucher Status</p>
                            </a>
                            <a href="{{route('bfas_tax_code_maint')}}" class="nav-link">
                                <p>Tax Code</p>
                            </a>
                            <a href="{{route('bfas_tax_type_maint')}}" class="nav-link">
                                <p>Tax Type</p>
                            </a>
                            <a href="{{route('bfas_journal_type_maint')}}" class="nav-link">
                                <p>Journal Type</p>
                            </a>
                            <a href="{{route('bfas_appropriation_type_maint')}}" class="nav-link">
                                Appropriation Type</p>
                            </a>
                            <a href="{{route('bfas_expenditure_type_maint')}}" class="nav-link">
                                Expenditure Type</p>
                            </a>
                            <a href="{{route('bfas_account_code_maint')}}" class="nav-link">
                                Account Code</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BDRIS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('alert_level_maint')}}" class="nav-link">
                                Alert Level</p>
                            </a>
                            <a href="{{route('level_of_damage_maint')}}" class="nav-link">
                                Level of Damage</p>
                            </a>
                            <a href="{{route('casualty_status_maint')}}" class="nav-link">
                                Casualty Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            PSGC
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                Barangay</p>
                            </a>
                            <a href="" class="nav-link">
                                City Municipality</p>
                            </a>
                            <a href="" class="nav-link">
                                Province</p>
                            </a>
                            <a href="" class="nav-link">
                                Region</p>
                            </a>
                            <a href="" class="nav-link">
                                Country</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BJISBH
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('case_maint')}}" class="nav-link">
                                Case</p>
                            </a>
                            <a href="{{route('case_type_maint')}}" class="nav-link">
                                Case Type</p>
                            </a>
                            <a href="{{route('type_of_involved_party_maint')}}" class="nav-link">
                                Type of Involved Party</p>
                            </a>
                            <a href="{{route('violation_status_maint')}}" class="nav-link">
                                Violation Status</p>
                            </a>
                            <a href="{{route('summons_status_maint')}}" class="nav-link">
                                Summons Status</p>
                            </a>
                            <a href="{{route('service_rate_maint')}}" class="nav-link">
                                Service Rate</p>
                            </a>
                            <a href="{{route('proceedings_status_maint')}}" class="nav-link">
                                Proceedings Status</p>
                            </a>
                            <a href="{{route('type_of_action_maint')}}" class="nav-link">
                                Type of Action </p>
                            </a>
                            <a href="{{route('type_of_penalties_maint')}}" class="nav-link">
                                Type of Penalties</p>
                            </a>
                            <a href="{{route('blotter_status_maint')}}" class="nav-link">
                                Blotter Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BIS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                Term Status</p>
                            </a>
                            <a href="{{route('categories_maint')}}" class="nav-link">
                                BIS Categories</p>
                            </a>
                            <a href="{{route('frequency_maint')}}" class="nav-link">
                                BIS Frequency</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BINS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bins_uom_maint')}}" class="nav-link">
                                Unit of Measure</p>
                            </a>
                            <a href="{{route('bins_bes_maint')}}" class="nav-link">
                                Borrowed Equipment Status</p>
                            </a>
                            <a href="{{route('bins_item_category_maint')}}" class="nav-link">
                                Item Category</p>
                            </a>
                            <a href="{{route('bins_item_class_maint')}}" class="nav-link">
                                Item Classificiation</p>
                            </a>
                            <a href="{{route('bins_item_status_maint')}}" class="nav-link">
                                Item Status</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BPMS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('project_type_maint')}}" class="nav-link">
                                Project Type</p>
                            </a>
                            <a href="{{route('accomplishment_status_maint')}}" class="nav-link">
                                Accomplishment Status</p>
                            </a>
                            <a href="{{route('project_status_maint')}}" class="nav-link">
                                Project Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BRGY WEB
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bweb_ann_status_maint')}}" class="nav-link">
                                Announcement Status</p>
                            </a>
                            <a href="{{route('bweb_ann_type_maint')}}" class="nav-link">
                                Announcement Type</p>
                            </a>
                            <a href="{{route('bweb_news_status_maint')}}" class="nav-link">
                                News Status</p>
                            </a>
                            <a href="{{route('bweb_news_type_maint')}}" class="nav-link">
                                News Type</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('user_list')}}" class="nav-link">
                                User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @elseif (Auth::user()->User_Type_ID == 2)
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BIPS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('inhabitant_application')}}" class="nav-link">
                                Inhabitants Info</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            BCPCIS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('brgy_document_information_details_request')}}" class="nav-link">
                                Document Request</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('justice_rating_inhabitants')}}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Justice Rating
                        </p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>