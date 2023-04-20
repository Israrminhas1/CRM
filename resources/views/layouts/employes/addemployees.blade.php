@extends('layout.master')
@section('parentPageTitle', 'Tables')
@section('title', 'Add Employees')


@section('content')



<div class="row clearfix">

    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Add Employees</h2>
                <ul class="header-dropdown dropdown">

                    <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>

                </ul>
            </div>
            <div class="body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" method="post" action="{{url('add-employees')}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-body">
                        <div class="caption font-red-sunglo">
                            <span class="text-theme font-weight-bold uppercase "> Basic Info</span>
                            <hr>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('full_name')) ? 'has-error' : 'has-info'}} ">
                                <div class="input-group">
                                    <label for="form_control_1">Full Name</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span></div>
                                    <input type="text" name="full_name" class="form-control"  value="{{old('full_name')}}" placeholder="Full Name">
                                        @if ($errors->any() && $errors->first('full_name'))
                                        <span class="text-danger w-100 small">{{$errors->first('full_name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('father_name')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Father Name</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span></div>
                                    <input type="text" name="father_name" class="form-control"  value="{{old('father_name')}}" placeholder="Father Name">
                                        @if ($errors->any() && $errors->first('father_name'))
                                        <span class="text-danger w-100 small">{{$errors->first('father_name')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group c_form_group {{(@$errors->any() && $errors->first('basic_salary')) ? 'has-error' : 'has-info'}}">
                            <div class="input-group">
                                <label for="form_control_1">Basic Salary</label>
                                <div class="input-group-prepend"><span class="input-group-text">
                                    <i class="fa fa-dollar"></i>
                                </span></div>
                                <input type="number" name="basic_salary" class="form-control"  value="{{old('basic_salary')}}" placeholder="Basic Salary E.g 5000">
                                    @if ($errors->any() && $errors->first('basic_salary'))
                                        <span class="text-danger w-100 small">{{$errors->first('basic_salary')}}</span>
                                    @endif
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('salary')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Salary</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-dollar"></i>
                                    </span></div>
                                    <input type="number" name="salary" class="form-control"  value="{{old('salary')}}" placeholder="Salary">
                                        @if ($errors->any() && $errors->first('salary'))
                                        <span class="text-danger w-100 small">{{$errors->first('salary')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group">
                                BreakUp Type <br>
                                <select class="form-control single2" name="breakupType" >
                                    <option value="" disabled selected> Select BreakUp Type</option>
        
                                    @foreach ($breakupTypes as $breakupType)
                                    <option value="{{  $breakupType->id }}" > {{  $breakupType->name }}</option>
                                    @endforeach
                                </select>
        
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('dob')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">DOB</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-birthday-cake"></i>
                                    </span></div>
                                    <input type="text" data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" name="dob" class="form-control"  value="{{old('dob')}}" placeholder="Date Of Birth">
                                        @if ($errors->any() && $errors->first('dob'))
                                        <span class="text-danger w-100 small">{{$errors->first('dob')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group">
                                <label>Gender</label>

                                <label class="fancy-radio custom-color-green" style="width: auto;margin-bottom: 0px">
                                    <input type="radio" id="radio14" value="M" name="gender" {{old('gender') == 'M' ? "checked" : "checked"}} >
                                    <span><i></i> Male </span> </label>


                                <label class="fancy-radio custom-color-green" style="width: auto;margin-bottom: 0px">
                                    <input type="radio" id="radio15" value="F" name="gender"  {{old('gender') == 'F' ? "checked" : ""}} >
                                    <span><i></i> Female </span> </label>


                                <label class="fancy-radio custom-color-green" style="width: auto;margin-bottom: 0px">
                                    <input type="radio" id="radio16" value="O" name="gender" {{old('gender') == 'O' ? "checked" : ""}}>
                                    <span><i></i> Other </span> </label>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('current_address')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Current Address</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-map-marker"></i>
                                    </span></div>
                                    <input type="text" name="current_address" class="form-control"  value="{{old('current_address')}}" placeholder="Current Address">
                                        @if ($errors->any() && $errors->first('current_address'))
                                        <span class="text-danger w-100 small">{{$errors->first('current_address')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="caption font-red-sunglo">
                        <span class="text-theme font-weight-bold uppercase "> Contact Info</span>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('mobile')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Mobile</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-mobile-phone"></i>
                                    </span></div>
                                    <input type="number" name="mobile" class="form-control"  value="{{old('mobile')}}" placeholder="Mobile">
                                        @if ($errors->any() && $errors->first('mobile'))
                                        <span class="text-danger w-100 small">{{$errors->first('mobile')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('country')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Select Country</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-map-o"></i>
                                    </span></div>
                                    {{-- <input type="text" name="country" class="form-control"  value="{{old('name')}}" placeholder="Country"> --}}
                                    <select name="country" class="form-control single2">
                                        <option value="{{old('country')}}"  disabled selected >{{!empty(old('country')) ? old('country') : "Select Country"}}</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="North Macedonia">North Macedonia</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                        @if ($errors->any() && $errors->first('country'))
                                        <span class="text-danger w-100 small">{{$errors->first('country')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('country_contact')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Home Country Contact</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span></div>
                                    <input type="text" name="country_contact" class="form-control"  value="{{old('country_contact')}}" placeholder="Home Country Contact">
                                        @if ($errors->any() && $errors->first('country_contact'))
                                        <span class="text-danger w-100 small">{{$errors->first('country_contact')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('country_phone')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Home Country Phone</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span></div>
                                    <input type="number" name="country_phone" class="form-control"  value="{{old('country_phone')}}" placeholder="Home Country Phone">
                                        @if ($errors->any() && $errors->first('country_phone'))
                                        <span class="text-danger w-100 small">{{$errors->first('country_phone')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('country_address')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Home Country Address</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-map-marker"></i>
                                    </span></div>
                                    <input type="text" name="country_address" class="form-control"  value="{{old('country_address')}}" placeholder="Home Country Address">
                                        @if ($errors->any() && $errors->first('country_address'))
                                        <span class="text-danger w-100 small">{{$errors->first('country_address')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="caption font-red-sunglo">
                        <span class="text-theme font-weight-bold uppercase "> Visa Info</span>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('designation')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Designation</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-steam"></i>
                                    </span></div>
                                    <input type="text" name="designation" class="form-control"  value="{{old('designation')}}" placeholder="Designation">
                                        @if ($errors->any() && $errors->first('designation'))
                                        <span class="text-danger w-100 small">{{$errors->first('designation')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('join_date')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Joining Date</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-calendar-check-o"></i>
                                    </span></div>
                                    <input type="text"  data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" name="join_date" class="form-control"  value="{{old('join_date')}}" placeholder="Joining Date">
                                        @if ($errors->any() && $errors->first('join_date'))
                                        <span class="text-danger w-100 small">{{$errors->first('join_date')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('visa_title')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Visa Title</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-cc-visa"></i>
                                    </span></div>
                                    <select name="visa_title" class="form-control">
                                        <option value="{{old('visa_title')}}"  selected="selected">{{!empty(old('visa_title')) ? old('visa_title') : "Select Visa Title"}}</option>
                                        {{-- <option  value="">Select Visa Title</option> --}}
                                        <option >Visit</option>
                                        <option >Resident</option>
                                        <option >Family</option>
                                    </select>

                                        @if ($errors->any() && $errors->first('visa_title'))
                                        <span class="text-danger w-100 small">{{$errors->first('visa_title')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('visa_expiry')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Visa Expiry</label>
                                    <div class="input-group-prepend"><span class="input-group-text">
                                        <i class="fa fa-calendar-minus-o"></i>
                                    </span></div>
                                    <input name="visa_expiry"  data-provide="datepicker" data-date-autoclose="true" data-date-format="yyyy-mm-dd" type="text" class="form-control"  value="{{old('visa_expiry')}}" placeholder="Visa Expiry">
                                        @if ($errors->any() && $errors->first('visa_expiry'))
                                        <span class="text-danger w-100 small">{{$errors->first('visa_expiry')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group c_form_group {{(@$errors->any() && $errors->first('image')) ? 'has-error' : 'has-info'}}">
                                <div class="input-group">
                                    <label for="form_control_1">Profile Image</label>
                                  
                                    <input type="file" name="image" class="form-control"  value="{{old('image')}}" placeholder="Profile Image">
                                    @if ($errors->any() && $errors->first('image'))
                                        <span class="help-block">{{$errors->first('image')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                       
                    </div>




                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn btn-primary  plain">Submit</button>
                        <button type="button" class="btn btn-default" onclick="cancelFunction('{{url('list-employees')}}')">Cancel</button>
                    </div>
                </form>
            <!-- END FORM-->
            </div>
        </div>
    </div>
</div>

    @stop

@section('page-styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap.min.css') }}">
@stop
@section('vendor-script')

<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@stop

@section('page-script')
<script>
    $(document).ready(function() {
        $('.single2').select2({
    theme: "bootstrap" // need to override the changed default
});
    });
</script>
@stop
