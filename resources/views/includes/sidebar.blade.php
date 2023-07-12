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
                <a href="{{route('home')}}">
                    <li class="nav-header" style="font-size: 20px;">Home</li>
                </a>
                <li class="nav-header" style="font-size: 20px;">Transactions</li>
                <li class="nav-item boris_main">
                    <a href="#" class="nav-link boris_menu" title="Barangay Ordinance And Resolution">
                        <img src="{{ asset('css/logos/Ordinance &Resolution.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Ordinance & Resolution
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('ordinances_and_resolutions_list')}}" class="nav-link ordinance">
                                <p>Ordinance Information</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('resolutions_list')}}" class="nav-link resolution">
                                <p>Resolution Information</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item inhabitants_main">
                    <a href="#" class="nav-link inhabitants_menu">
                        <img src="{{ asset('css/logos/Inhabitants.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Inhabitants
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('inhabitants_information_list')}}" class="nav-link inhabitants">
                                <p>Inhabitants List</p>
                            </a>
                            <a href="{{route('inhabitants_household_profile')}}" class="nav-link household">
                                <p>Household Profile</p>
                            </a>
                            <a href="{{route('deceased_profile_list')}}" class="nav-link deceased_profile">
                                <p>Deceased Profile</p>
                            </a>
                            @if (Auth::user()->User_Type_ID == 1)
                            <a href="{{route('inhabitants_transfer_list')}}" class="nav-link transfer">
                                <p>Inhabitants Transfer</p>
                            </a>
                            <a href="{{route('inhabitants_incoming_list')}}" class="nav-link incoming">
                                <p>Incoming List</p>
                            </a>
                            <a href="{{route('application_list')}}" class="nav-link application_list">
                                <p>Application List</p>
                            </a>
                            <a href="{{route('brgy_official_list')}}" class="nav-link brgy_official">
                                <p>Brgy. Official</p>
                            </a>
                            <a href="{{route('brgy_purok_leader_list')}}" class="nav-link brgy_purok">
                                <p>Brgy. Purok Leader</p>
                            </a>
                            <a href="{{route('processing_sched')}}" class="nav-link processingsched">
                                <p>Processing Schedule</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>
                <li class="nav-item certification_main">
                    <a href="#" class="nav-link certification_menu">
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
                            <a href="{{route('brgy_business_permit_list')}}" class="nav-link businessPermit">
                                <p>Business Permit</p>
                            </a>
                            <!-- <a href="" class="nav-link">
                                <p>Reports Generation</p>
                            </a> -->
                            <a href="{{route('brgy_document_information_list')}}" class="nav-link brgyDocument">
                                <p>Brgy Document Information</p>
                            </a>
                            <a href="{{route('barangay_business_list')}}" class="nav-link brgyBusiness">
                                <p>Barangay Business</p>
                            </a>
                            <!-- <a href="{{route('brgy_document_claim_business_list')}}" class="nav-link">
                                <p>Brgy Document Claim(Business Permit)</p>
                            </a> -->
                            @if (Auth::user()->User_Type_ID == 1)
                            <a href="{{route('document_request_pending_list')}}" class="nav-link documentRequest">
                                <p>Document Request Pending</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>
                <li class="nav-item accounting_main">
                    <a href="#" class="nav-link accounting_menu">
                        <img src="{{ asset('css/logos/Accounting.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Accounting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bfas_accounts_information')}}" class="nav-link chartAccounts">
                                <p>Chart of Accounts</p>
                            </a>
                            <a href="{{route('bfas_jev_collection')}}" class="nav-link JEVCollection">
                                <p>JEV Collection</p>
                            </a>
                            <a href="{{route('bfas_jev_disbursement')}}" class="nav-link JEVDisbursement">
                                <p>JEV Disbursement</p>
                            </a>
                            <a href="{{route('bfas_budget_appropriation')}}" class="nav-link budgetApprop">
                                <p>Budget Appropriation</p>
                            </a>
                            <a href="bfas_SAAODBA" class="nav-link budgetSAAODBA">
                                <p>Budget SAAODBA</p>
                            </a>
                            <a href="{{route('bfas_obligation_request')}}" class="nav-link obligationRequest">
                                <p>Obligation Request</p>
                            </a>
                            <a href="{{route('bfas_disbursement_voucher')}}" class="nav-link disbursementVoucher">
                                <p>Disbursement Voucher</p>
                            </a>
                            <a href="{{route('bfas_check_preparation')}}" class="nav-link checkPrep">
                                <p>Check Preparation</p>
                            </a>
                            <a href="{{route('bfas_check_status')}}" class="nav-link checkStatusClear">
                                <p>Check Status Cleared</p>
                            </a>
                            <a href="{{route('bfas_check_status_released')}}" class="nav-link checkStatusRel">
                                <p>Check Status Released</p>
                            </a>
                            <a href="{{route('bfas_payment_collection')}}" class="nav-link PaymentCol">
                                <p>Payment Collection</p>
                            </a>
                            <a href="{{route('bfas_card_file')}}" class="nav-link CardFile">
                                <p>Card File (Supplier)</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item disaster_main">
                    <a href="#" class="nav-link disaster_menu">
                        <img src="{{ asset('css/logos/Disaster Response.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Disaster Response
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('other_transaction_list')}}" class="nav-link otherTrans">
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
                            <a href="{{route('disaster_related_activities_list')}}" class="nav-link disasterActivities">
                                <p>Disaster Related Activities</p>
                            </a>
                            <a href="{{route('response_information_list')}}" class="nav-link responseInfo">
                                <p>Response Information</p>
                            </a>
                            <!-- <a href="" class="nav-link">
                                <p>Evacuee Information</p>
                            </a> -->
                            <a href="{{route('recovery_information_list')}}" class="nav-link recoveryInfo">
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
                <li class="nav-item justice_main">
                    <a href="#" class="nav-link justice_menu" title="Barangay Justice, Blotter and Help Desk Information System">
                        <img src="{{ asset('css/logos/Justice.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Justice
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('blotter_list')}}" class="nav-link Blotter">
                                <p>Blotter</p>
                            </a>
                            <a href="{{route('summon_list')}}" class="nav-link Summons">
                                <p>Summons</p>
                            </a>
                            <a href="{{route('proceeding_list')}}" class="nav-link Proceedings">
                                <p>Proceedings</p>
                            </a>
                            <a href="{{route('ordinance_violator_list')}}" class="nav-link OrdinanceViolator">
                                <p>Ordinance Violators</p>
                            </a>
                            <a href="{{route('justice_rating_staff')}}" class="nav-link JusticeRating">
                                <p>Justice Rating</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item inventory_main">
                    <a href="#" class="nav-link inventory_menu">
                        <img src="{{ asset('css/logos/Inventory.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bins_begbal')}}" class="nav-link BegBalance">
                                <p>Inventory Beginning Balance</p>
                            </a>
                            <a href="{{route('bins_inventory')}}" class="nav-link brgyInventory">
                                <p>Barangay Inventory</p>
                            </a>
                            <a href="{{route('bins_item_inspection')}}" class="nav-link itemIns">
                                <p>Item for Inspection</p>
                            </a>
                            <a href="{{route('bins_received_item')}}" class="nav-link receivedItem">
                                <p>Received Item</p>
                            </a>
                            <a href="{{route('bins_physical_count')}}" class="nav-link physicalCount">
                                <p>Physical Count</p>
                            </a>
                            <a href="{{route('bins_inv_disposal')}}" class="nav-link inventoryDispo">
                                <p>Inventory for Disposal</p>
                            </a>
                            <a href="{{route('bins_borrow')}}" class="nav-link EquipBorrow">
                                <p>Equipment Borrow Request</p>
                            </a>
                            {{-- <a href="{{route('bins_supply_issuance')}}" class="nav-link SuppliesIssuance">
                                <p>Supplies Issuance</p>
                            </a> --}}
                        </li>
                    </ul>
                </li>
                <li class="nav-item project_main">
                    <a href="#" class="nav-link project_menu">
                        <img src="{{ asset('css/logos/Projects.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Projects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('contractor_list')}}" class="nav-link projectcContractor">
                                <p>Contractor</p>
                            </a>
                            <a href="{{route('brgy_projects_monitoring_list')}}" class="nav-link projectMonitoring">
                                <p>Brgy Projects Monitoring</p>
                            </a>

                        </li>
                    </ul>
                </li>
                @elseif (Auth::user()->User_Type_ID == 3)
                <li class="nav-item cms_main">
                    <a href="#" class="nav-link cms_menu">
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
                            <a href="{{route('cms_list')}}" class="nav-link contentManage">
                                <p>Content Management System</p>
                            </a>

                        </li>
                    </ul>
                </li>
                @elseif (Auth::user()->User_Type_ID == 5)
                <li class="nav-item cms_dilg_main">
                    <a href="#" class="nav-link cms_dilg_menu">
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
                            <a href="{{route('cms_list')}}" class="nav-link ContentManageDILG">
                                <p>Content Management System</p>
                            </a>

                        </li>
                    </ul>
                </li>
                <li class="nav-header" style="font-size: 20px;">Maintenance</li>
                <li class="nav-item mboris_main">
                    <a href="#" class="nav-link mboris_menu">
                        <img src="{{ asset('css/logos/Ordinance &Resolution.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>Ordinance & Resolution
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('type_of_ordinance_maint')}}" class="nav-link mboris1">
                                <p>Type of Ordinance</p>
                            </a>
                            <a href="{{route('status_of_ordinance_maint')}}" class="nav-link mboris2">
                                <p>Status of Ordinance</p>
                            </a>
                            <a href="{{route('ordinance_category_maint')}}" class="nav-link mboris3">
                                <p>Ordinance Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item minhabitants_main">
                    <a href="#" class="nav-link minhabitants_menu">
                        <img src="{{ asset('css/logos/Inhabitants.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Inhabitants
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('blood_type_maint')}}" class="nav-link mI1">
                                <p>Blood Type</p>
                            </a>
                            <a href="{{route('deceased_type_maint')}}" class="nav-link mI2">
                                <p>Deceased Type</p>
                            </a>
                            <a href="{{route('civil_status_maint')}}" class="nav-link mI3">
                                <p>Civil Status</p>
                            </a>
                            <a href="{{route('name_prefix_maint')}}" class="nav-link mI4">
                                <p>Name Prefix</p>
                            </a>
                            <a href="{{route('family_position_maint')}}" class="nav-link mI5">
                                <p>Family Position</p>
                            </a>
                            <a href="{{route('academic_level_maint')}}" class="nav-link mI6">
                                <p>Academic Level</p>
                            </a>
                            <a href="{{route('housing_unit_maint')}}" class="nav-link mI7">
                                <p>Housing Unit</p>
                            </a>
                            <a href="{{route('religion_maint')}}" class="nav-link mI8">
                                <p>Religion</p>
                            </a>
                            <a href="{{route('family_type_maint')}}" class="nav-link mI9">
                                <p>Family Type</p>
                            </a>
                            <a href="{{route('employment_type_maint')}}" class="nav-link mI10">
                                <p>Employment Type</p>
                            </a>
                            <a href="{{route('tenure_of_lot_maint')}}" class="nav-link mI11">
                                <p>Tenure of Lot</p>
                            </a>
                            <a href="{{route('name_suffix_maint')}}" class="nav-link mI12">
                                <p>Name Suffix</p>
                            </a>
                            <a href="{{route('brgy_position_maint')}}" class="nav-link mI13">
                                <p>Brgy. Position</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mCert_main">
                    <a href="#" class="nav-link mCert_menu">
                        <img src="{{ asset('css/logos/Certification & Permits.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Certification & Permits
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('purpose_document_list')}}" class="nav-link mC1">
                                <p>Purpose of Document</p>
                            </a>
                            <a href="{{route('business_type_list')}}" class="nav-link mC2">
                                <p>Business Type</p>
                            </a>
                            <a href="{{route('document_type_list')}}" class="nav-link mC3">
                                <p>Document Type</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mAccount_main">
                    <a href="#" class="nav-link mAccount_menu">
                        <img src="{{ asset('css/logos/Accounting.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Accounting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bfas_type_of_fee_maint')}}" class="nav-link mAc1">
                                <p>Type of Fee</p>
                            </a>
                            <a href="{{route('bfas_card_type_maint')}}" class="nav-link mAc2">
                                <p>Card Type</p>
                            </a>
                            <a href="{{route('bfas_account_type_maint')}}" class="nav-link mAc3">
                                <p>Account Type</p>
                            </a>
                            <a href="{{route('bfas_fund_type_maint')}}" class="nav-link mAc4">
                                <p>Fund Type</p>
                            </a>
                            <a href="{{route('bfas_bank_account_maint')}}" class="nav-link mAc5">
                                <p>Bank Account</p>
                            </a>
                            <a href="{{route('bfas_voucher_status_maint')}}" class="nav-link mAc6">
                                <p>Voucher Status</p>
                            </a>
                            <a href="{{route('bfas_tax_code_maint')}}" class="nav-link mAc7">
                                <p>Tax Code</p>
                            </a>
                            <a href="{{route('bfas_tax_type_maint')}}" class="nav-link mAc8">
                                <p>Tax Type</p>
                            </a>
                            <a href="{{route('bfas_journal_type_maint')}}" class="nav-link mAc9">
                                <p>Journal Type</p>
                            </a>
                            <a href="{{route('bfas_appropriation_type_maint')}}" class="nav-link mAc10">
                                Appropriation Type</p>
                            </a>
                            <a href="{{route('bfas_expenditure_type_maint')}}" class="nav-link mAc11">
                                Expenditure Type</p>
                            </a>
                            <a href="{{route('bfas_account_code_maint')}}" class="nav-link mAc12">
                                Account Code</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mDis_main">
                    <a href="#" class="nav-link mDis_menu">
                        <img src="{{ asset('css/logos/Disaster Response.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Disaster Response
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('alert_level_maint')}}" class="nav-link mDis1">
                                Alert Level</p>
                            </a>
                            <a href="{{route('level_of_damage_maint')}}" class="nav-link mDis2">
                                Level of Damage</p>
                            </a>
                            <a href="{{route('casualty_status_maint')}}" class="nav-link mDis3">
                                Casualty Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item psgc_main">
                    <a href="#" class="nav-link psgc_menu">
                        <img src="{{ asset('css/logos/psgc.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            PSGC
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('barangay_maint')}}" class="nav-link psgc5">
                                Barangay</p>
                            </a>
                            <a href="{{route('city_maint')}}" class="nav-link psgc4">
                                City Municipality</p>
                            </a>
                            <a href="{{route('province_maint')}}" class="nav-link psgc3">
                                Province</p>
                            </a>
                            <a href="{{route('region_maint')}}" class="nav-link psgc2">
                                Region</p>
                            </a>
                            <a href="{{route('country_maint')}}" class="nav-link psgc1">
                                Country</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mJus_main">
                    <a href="#" class="nav-link mJus_menu">
                        <img src="{{ asset('css/logos/Justice.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Justice
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('case_maint')}}" class="nav-link mJus1">
                                Case</p>
                            </a>
                            <a href="{{route('case_type_maint')}}" class="nav-link mJus2">
                                Case Type</p>
                            </a>
                            <a href="{{route('type_of_involved_party_maint')}}" class="nav-link mJus3">
                                Type of Involved Party</p>
                            </a>
                            <a href="{{route('violation_status_maint')}}" class="nav-link mJus4">
                                Violation Status</p>
                            </a>
                            <a href="{{route('summons_status_maint')}}" class="nav-link mJus5">
                                Summons Status</p>
                            </a>
                            <a href="{{route('service_rate_maint')}}" class="nav-link mJus6">
                                Service Rate</p>
                            </a>
                            <a href="{{route('proceedings_status_maint')}}" class="nav-link mJus7">
                                Proceedings Status</p>
                            </a>
                            <a href="{{route('type_of_action_maint')}}" class="nav-link mJus8">
                                Type of Action </p>
                            </a>
                            <a href="{{route('type_of_penalties_maint')}}" class="nav-link mJus9">
                                Type of Penalties</p>
                            </a>
                            <a href="{{route('blotter_status_maint')}}" class="nav-link mJus10">
                                Blotter Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mBis_main">
                    <a href="#" class="nav-link mBis_menu">
                        <img src="{{ asset('css/logos/BIS.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            BIS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('termstatus_maint')}}" class="nav-link mBis3">
                                Term Status</p>
                            </a>
                            <a href="{{route('categories_maint')}}" class="nav-link mBis1">
                                BIS Categories</p>
                            </a>
                            <a href="{{route('frequency_maint')}}" class="nav-link mBis2">
                                BIS Frequency</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mInv_main">
                    <a href="#" class="nav-link mInv_menu">
                        <img src="{{ asset('css/logos/Inventory.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bins_uom_maint')}}" class="nav-link mInv1">
                                Unit of Measure</p>
                            </a>
                            <a href="{{route('bins_bes_maint')}}" class="nav-link mInv5">
                                Borrowed Equipment Status</p>
                            </a>
                            <a href="{{route('bins_item_category_maint')}}" class="nav-link mInv2">
                                Item Category</p>
                            </a>
                            <a href="{{route('bins_item_class_maint')}}" class="nav-link mInv3">
                                Item Classificiation</p>
                            </a>
                            <a href="{{route('bins_item_status_maint')}}" class="nav-link mInv4">
                                Item Status</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item mPro_main">
                    <a href="#" class="nav-link mPro_menu">
                        <img src="{{ asset('css/logos/Projects.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Projects
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('project_type_maint')}}" class="nav-link mPro1">
                                Project Type</p>
                            </a>
                            <a href="{{route('accomplishment_status_maint')}}" class="nav-link mPo2">
                                Accomplishment Status</p>
                            </a>
                            <a href="{{route('project_status_maint')}}" class="nav-link mPro3">
                                Project Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mWeb_main">
                    <a href="#" class="nav-link mWeb_menu">
                        <img src="{{ asset('css/logos/web.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            BRGY WEB
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('bweb_ann_status_maint')}}" class="nav-link mWbe1">
                                Announcement Status</p>
                            </a>
                            <a href="{{route('bweb_ann_type_maint')}}" class="nav-link mWbe2">
                                Announcement Type</p>
                            </a>
                            <a href="{{route('bweb_news_status_maint')}}" class="nav-link mWbe3">
                                News Status</p>
                            </a>
                            <a href="{{route('bweb_news_type_maint')}}" class="nav-link mWbe4">
                                News Type</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item mUser_main">
                    <a href="#" class="nav-link mUser_menu">
                        <img src="{{ asset('css/logos/Inhabitants.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('user_list')}}" class="nav-link mUser1">
                                User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @elseif (Auth::user()->User_Type_ID == 2)
                <li class="nav-item uInh_main">
                    <a href="#" class="nav-link uInh_menu">
                        <img src="{{ asset('css/logos/Inhabitants.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Inhabitants
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('inhabitant_application')}}" class="nav-link uInh1">
                                Inhabitants Info</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item uICert_main">
                    <a href="#" class="nav-link uICert_main">
                        <img src="{{ asset('css/logos/Certification & Permits.png') }}" style="opacity: .8;" height="28" width="28">
                        <p>
                            Certification and Permits
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('document_request_list')}}" class="nav-link uICert1">
                                Document Request</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item uIJus_main">
                    <a href="{{route('justice_rating_inhabitants')}}" class="nav-link uIJus_menu">
                        <img src="{{ asset('css/logos/Justice.png') }}" style="opacity: .8;" height="28" width="28">
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