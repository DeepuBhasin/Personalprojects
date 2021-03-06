<!DOCTYPE html>
<html>

<head>
	<title>SMS Service By Henrry Goels</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body style="background-color:#0083C4;">
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="#">SMS Service By Henrry Goels</a>
			</div>
		</div>
	</nav>

	<div class="container">
		<?php
		if (isset($_POST['send'])) {

			$api_type = $_POST['api_type'];
			$country_id = '+'.$_POST['country_id'];

			$dir = "textfile/";
			$b = scandir($dir, 1);

			$count = count($b) - 2;

			for ($x = 0; $x < $count; $x++) {

				if (!empty($b[$x])) {
					unlink('textfile/' . $b[$x]);
				}
			}

			$RandomAccountNumber = uniqid();
			$upload = $RandomAccountNumber . ($_FILES['mobile']['name']);
			$source = $_FILES['mobile']['tmp_name'];
			$target = 'textfile/' . $upload;
			move_uploaded_file($source, $target);

			$dir = "textfile/";
			$b = scandir($dir, 1);

			$count = count($b) - 2;

			for ($x = 0; $x < $count; $x++) {

				$file_name = $b[$x];
			}

			$file = fopen("textfile/" . $file_name, "r");
			$z = 0;
			while (!feof($file)) {
				$number[$z] = (float) fgets($file);
				++$z;
			}
			fclose($file);
			// var_dump($number);
			// exit;
			$message=$_POST['message'];
			
			
			if ($message == '') { ?>
				<div class="col-md-8 col-lg-offset-2">
					<div class="alert alert-danger msg">
						Please Fill Out All Mandontary Fields.
						<script type="text/javascript">
							setTimeout(function() {
								$('.msg').hide();
							}, 3000);
						</script>
					</div>
				</div>
				<?php
			} else {
				if ($api_type == 'clickatell') {
					for ($x = 0; $x < count($number); $x++) {

						$url = 'https://platform.clickatell.com/messages/http/send?apiKey=2QmXl_bTTiu8PL1JceJBFA==&to='.$country_id.$number[$x] . '&content=' . urlencode(htmlentities(trim($_POST['message'])));
						$response = file_get_contents($url);
						// print_r($response);
						// exit;

						if (strpos($response, 'Error')) {
							$success[$x] = $country_id.$number[$x];
							$status[$x] = "Failed";
							// $reason[$x] = $response;
							$yes = true;
						} else {
							$success[$x] = $country_id.$number[$x];
							// $reason[$x] = $response;
							$status[$x] = "Sent";
							$yes = true;
						}
					}
				}

				else if($api_type=='twillio')
				{
					$from='+14344488990';
					for($i=0;$i<count($number);$i++)
					{
						$sid = 'AC18b201d74f9add8aca913748d41711ad';
			        	$auth = '7c93de7bb8ba19a8e37d814836428f0c';
			        	
			        	$api = curl_init("https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json");
				        curl_setopt_array($api, array(
				            CURLOPT_RETURNTRANSFER => 1,
				            CURLOPT_POST => 1,
				            CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode($sid.':'.$auth)),
				            CURLOPT_POSTFIELDS => array(
				                'Body' =>$_POST['message'],
				                'To' => $country_id.$number[$i],
				                'From' => $from,
				            )
				        ));
					    
						$resp = curl_exec($api);
				        $resp=json_decode($resp, true);

				        if(isset($resp['sid']))
				        {
				        	 $success[$i]=$country_id.$number[$i];
				        	 $status[$i]="Sent";
				        	 $yes=true;
				        }
				        else
				        {
				        	$success[$i]=$country_id.$number[$i];
				        	$status[$i]="Failed";
				        	$yes=true;
				        }
					}
				}
				if (isset($yes)) {
				?>
					<div class="row">
						<div class="col-md-8 col-lg-offset-2">
							<div class="alert alert-success msg">
								Program Execute Successfully
								<!-- <script type="text/javascript">
								setTimeout(function(){$('.msg').hide();},3000);
							</script> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="table-responsive col-md-8 col-lg-offset-2" style="background-color: #9AE2CD;">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Serial No.</th>
										<th>Phone Number.</th>
										<th>Api Type</th>
										<th>Status</th>
										<!-- <th>Reason</th> -->

									</tr>
								</thead>
								<tbody>
									<?php
									$x = 0;
									for ($i = 0; $i < count($success); $i++) { ?>
										<tr>
											<td><?= ++$x ?></td>
											<td><?= $success[$i] ?></td>
											<td><?= $status[$i] ?></td>
											<!-- <td><?= $reason[$i] ?></td> -->
											<td><?= ucfirst($api_type); ?></td>
										</tr>
									<?php
									}

									?>
								</tbody>
							</table>
						</div>
					</div>
					<br><br><br><br>
		<?php
				}
			}
		}
		?>
		<div class="col-md-8 col-md-offset-2">
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
				<div class="form-group">
					<label for="api_type" class="control-label" style="color: #fff;">Api Type</label>
					<select name="api_type" id="api_type" required class="form-control">
						<option value="">Select Api</option>
						<option value="clickatell">Clickatell</option>
						<option value="twillio">Twillio</option>
					</select>
				</div>
				<div class="form-group">
					<label for="mobile" class="control-label" style="color: #fff;">Upload Text File</label>
					<input type="file" id="mobile" class="form-control" name="mobile" placeholder="" required="">
				</div>
				<div class="form-group">
                          <label for="country_id" style="color: #fff;">Select Country *</label>
                          <select class="form-control" name="country_id" required="" id="country_id">
                          <option value="">Select Country </option>
                                                    <option value="93">Afghanistan ( 93 )</option>
                                                    <option value="358">Aland islands ( 358 )</option>
                                                    <option value="355">Albania ( 355 )</option>
                                                    <option value="213">Algeria ( 213 )</option>
                                                    <option value="1684">American samoa ( 1684 )</option>
                                                    <option value="376">Andorra ( 376 )</option>
                                                    <option value="244">Angola ( 244 )</option>
                                                    <option value="1264">Anguilla ( 1264 )</option>
                                                    <option value="0">Antarctica ( 0 )</option>
                                                    <option value="1268">Antigua and barbuda ( 1268 )</option>
                                                    <option value="54">Argentina ( 54 )</option>
                                                    <option value="374">Armenia ( 374 )</option>
                                                    <option value="297">Aruba ( 297 )</option>
                                                    <option value="0">Asia pacific region ( 0 )</option>
                                                    <option value="61">Australia ( 61 )</option>
                                                    <option value="43">Austria ( 43 )</option>
                                                    <option value="994">Azerbaijan ( 994 )</option>
                                                    <option value="1242">Bahamas ( 1242 )</option>
                                                    <option value="973">Bahrain ( 973 )</option>
                                                    <option value="880">Bangladesh ( 880 )</option>
                                                    <option value="1246">Barbados ( 1246 )</option>
                                                    <option value="375">Belarus ( 375 )</option>
                                                    <option value="32">Belgium ( 32 )</option>
                                                    <option value="501">Belize ( 501 )</option>
                                                    <option value="229">Benin ( 229 )</option>
                                                    <option value="1441">Bermuda ( 1441 )</option>
                                                    <option value="975">Bhutan ( 975 )</option>
                                                    <option value="591">Bolivia ( 591 )</option>
                                                    <option value="599">Bonaire, sint eustatius and saba ( 599 )</option>
                                                    <option value="387">Bosnia and herzegovina ( 387 )</option>
                                                    <option value="267">Botswana ( 267 )</option>
                                                    <option value="0">Bouvet island ( 0 )</option>
                                                    <option value="55">Brazil ( 55 )</option>
                                                    <option value="246">British indian ocean territory ( 246 )</option>
                                                    <option value="673">Brunei darussalam ( 673 )</option>
                                                    <option value="359">Bulgaria ( 359 )</option>
                                                    <option value="226">Burkina faso ( 226 )</option>
                                                    <option value="257">Burundi ( 257 )</option>
                                                    <option value="855">Cambodia ( 855 )</option>
                                                    <option value="237">Cameroon ( 237 )</option>
                                                    <option value="1">Canada ( 1 )</option>
                                                    <option value="238">Cape verde ( 238 )</option>
                                                    <option value="1345">Cayman islands ( 1345 )</option>
                                                    <option value="236">Central african republic ( 236 )</option>
                                                    <option value="235">Chad ( 235 )</option>
                                                    <option value="56">Chile ( 56 )</option>
                                                    <option value="86">China ( 86 )</option>
                                                    <option value="61">Christmas island ( 61 )</option>
                                                    <option value="672">Cocos (keeling) islands ( 672 )</option>
                                                    <option value="57">Colombia ( 57 )</option>
                                                    <option value="269">Comoros ( 269 )</option>
                                                    <option value="242">Congo ( 242 )</option>
                                                    <option value="242">Congo, the democratic republic of the ( 242 )</option>
                                                    <option value="682">Cook islands ( 682 )</option>
                                                    <option value="506">Costa rica ( 506 )</option>
                                                    <option value="225">Cote d'ivoire ( 225 )</option>
                                                    <option value="385">Croatia ( 385 )</option>
                                                    <option value="53">Cuba ( 53 )</option>
                                                    <option value="599">Curacao ( 599 )</option>
                                                    <option value="357">Cyprus ( 357 )</option>
                                                    <option value="420">Czech republic ( 420 )</option>
                                                    <option value="45">Denmark ( 45 )</option>
                                                    <option value="253">Djibouti ( 253 )</option>
                                                    <option value="1767">Dominica ( 1767 )</option>
                                                    <option value="1809">Dominican republic ( 1809 )</option>
                                                    <option value="593">Ecuador ( 593 )</option>
                                                    <option value="20">Egypt ( 20 )</option>
                                                    <option value="503">El salvador ( 503 )</option>
                                                    <option value="240">Equatorial guinea ( 240 )</option>
                                                    <option value="291">Eritrea ( 291 )</option>
                                                    <option value="372">Estonia ( 372 )</option>
                                                    <option value="251">Ethiopia ( 251 )</option>
                                                    <option value="500">Falkland islands (malvinas) ( 500 )</option>
                                                    <option value="298">Faroe islands ( 298 )</option>
                                                    <option value="679">Fiji ( 679 )</option>
                                                    <option value="358">Finland ( 358 )</option>
                                                    <option value="33">France ( 33 )</option>
                                                    <option value="594">French guiana ( 594 )</option>
                                                    <option value="689">French polynesia ( 689 )</option>
                                                    <option value="0">French southern territories ( 0 )</option>
                                                    <option value="241">Gabon ( 241 )</option>
                                                    <option value="220">Gambia ( 220 )</option>
                                                    <option value="995">Georgia ( 995 )</option>
                                                    <option value="49">Germany ( 49 )</option>
                                                    <option value="233">Ghana ( 233 )</option>
                                                    <option value="350">Gibraltar ( 350 )</option>
                                                    <option value="30">Greece ( 30 )</option>
                                                    <option value="299">Greenland ( 299 )</option>
                                                    <option value="1473">Grenada ( 1473 )</option>
                                                    <option value="590">Guadeloupe ( 590 )</option>
                                                    <option value="1671">Guam ( 1671 )</option>
                                                    <option value="502">Guatemala ( 502 )</option>
                                                    <option value="44">Guernsey ( 44 )</option>
                                                    <option value="224">Guinea ( 224 )</option>
                                                    <option value="245">Guinea-bissau ( 245 )</option>
                                                    <option value="592">Guyana ( 592 )</option>
                                                    <option value="509">Haiti ( 509 )</option>
                                                    <option value="0">Heard island and mcdonald islands ( 0 )</option>
                                                    <option value="39">Holy see (vatican city state) ( 39 )</option>
                                                    <option value="504">Honduras ( 504 )</option>
                                                    <option value="852">Hong kong ( 852 )</option>
                                                    <option value="36">Hungary ( 36 )</option>
                                                    <option value="354">Iceland ( 354 )</option>
                                                    <option value="91">India ( 91 )</option>
                                                    <option value="62">Indonesia ( 62 )</option>
                                                    <option value="98">Iran, islamic republic of ( 98 )</option>
                                                    <option value="964">Iraq ( 964 )</option>
                                                    <option value="353">Ireland ( 353 )</option>
                                                    <option value="44">Isle of man ( 44 )</option>
                                                    <option value="972">Israel ( 972 )</option>
                                                    <option value="39">Italy ( 39 )</option>
                                                    <option value="1876">Jamaica ( 1876 )</option>
                                                    <option value="81">Japan ( 81 )</option>
                                                    <option value="44">Jersey ( 44 )</option>
                                                    <option value="962">Jordan ( 962 )</option>
                                                    <option value="7">Kazakhstan ( 7 )</option>
                                                    <option value="254">Kenya ( 254 )</option>
                                                    <option value="686">Kiribati ( 686 )</option>
                                                    <option value="850">Korea, democratic people's republic of ( 850 )</option>
                                                    <option value="82">Korea, republic of ( 82 )</option>
                                                    <option value="381">Kosovo ( 381 )</option>
                                                    <option value="965">Kuwait ( 965 )</option>
                                                    <option value="996">Kyrgyzstan ( 996 )</option>
                                                    <option value="856">Lao people's democratic republic ( 856 )</option>
                                                    <option value="371">Latvia ( 371 )</option>
                                                    <option value="961">Lebanon ( 961 )</option>
                                                    <option value="266">Lesotho ( 266 )</option>
                                                    <option value="231">Liberia ( 231 )</option>
                                                    <option value="218">Libyan arab jamahiriya ( 218 )</option>
                                                    <option value="423">Liechtenstein ( 423 )</option>
                                                    <option value="370">Lithuania ( 370 )</option>
                                                    <option value="352">Luxembourg ( 352 )</option>
                                                    <option value="853">Macao ( 853 )</option>
                                                    <option value="389">Macedonia, the former yugoslav republic of ( 389 )</option>
                                                    <option value="261">Madagascar ( 261 )</option>
                                                    <option value="265">Malawi ( 265 )</option>
                                                    <option value="60">Malaysia ( 60 )</option>
                                                    <option value="960">Maldives ( 960 )</option>
                                                    <option value="223">Mali ( 223 )</option>
                                                    <option value="356">Malta ( 356 )</option>
                                                    <option value="692">Marshall islands ( 692 )</option>
                                                    <option value="596">Martinique ( 596 )</option>
                                                    <option value="222">Mauritania ( 222 )</option>
                                                    <option value="230">Mauritius ( 230 )</option>
                                                    <option value="269">Mayotte ( 269 )</option>
                                                    <option value="52">Mexico ( 52 )</option>
                                                    <option value="691">Micronesia, federated states of ( 691 )</option>
                                                    <option value="373">Moldova, republic of ( 373 )</option>
                                                    <option value="377">Monaco ( 377 )</option>
                                                    <option value="976">Mongolia ( 976 )</option>
                                                    <option value="382">Montenegro ( 382 )</option>
                                                    <option value="1664">Montserrat ( 1664 )</option>
                                                    <option value="212">Morocco ( 212 )</option>
                                                    <option value="258">Mozambique ( 258 )</option>
                                                    <option value="95">Myanmar ( 95 )</option>
                                                    <option value="264">Namibia ( 264 )</option>
                                                    <option value="674">Nauru ( 674 )</option>
                                                    <option value="977">Nepal ( 977 )</option>
                                                    <option value="31">Netherlands ( 31 )</option>
                                                    <option value="599">Netherlands antilles ( 599 )</option>
                                                    <option value="687">New caledonia ( 687 )</option>
                                                    <option value="64">New zealand ( 64 )</option>
                                                    <option value="505">Nicaragua ( 505 )</option>
                                                    <option value="227">Niger ( 227 )</option>
                                                    <option value="234">Nigeria ( 234 )</option>
                                                    <option value="683">Niue ( 683 )</option>
                                                    <option value="672">Norfolk island ( 672 )</option>
                                                    <option value="1670">Northern mariana islands ( 1670 )</option>
                                                    <option value="47">Norway ( 47 )</option>
                                                    <option value="968">Oman ( 968 )</option>
                                                    <option value="92">Pakistan ( 92 )</option>
                                                    <option value="680">Palau ( 680 )</option>
                                                    <option value="970">Palestinian territory, occupied ( 970 )</option>
                                                    <option value="507">Panama ( 507 )</option>
                                                    <option value="675">Papua new guinea ( 675 )</option>
                                                    <option value="595">Paraguay ( 595 )</option>
                                                    <option value="51">Peru ( 51 )</option>
                                                    <option value="63">Philippines ( 63 )</option>
                                                    <option value="0">Pitcairn ( 0 )</option>
                                                    <option value="48">Poland ( 48 )</option>
                                                    <option value="351">Portugal ( 351 )</option>
                                                    <option value="1787">Puerto rico ( 1787 )</option>
                                                    <option value="974">Qatar ( 974 )</option>
                                                    <option value="262">Reunion ( 262 )</option>
                                                    <option value="40">Romania ( 40 )</option>
                                                    <option value="70">Russian federation ( 70 )</option>
                                                    <option value="250">Rwanda ( 250 )</option>
                                                    <option value="590">Saint barthelemy ( 590 )</option>
                                                    <option value="290">Saint helena ( 290 )</option>
                                                    <option value="1869">Saint kitts and nevis ( 1869 )</option>
                                                    <option value="1758">Saint lucia ( 1758 )</option>
                                                    <option value="590">Saint martin ( 590 )</option>
                                                    <option value="508">Saint pierre and miquelon ( 508 )</option>
                                                    <option value="1784">Saint vincent and the grenadines ( 1784 )</option>
                                                    <option value="684">Samoa ( 684 )</option>
                                                    <option value="378">San marino ( 378 )</option>
                                                    <option value="239">Sao tome and principe ( 239 )</option>
                                                    <option value="966">Saudi arabia ( 966 )</option>
                                                    <option value="221">Senegal ( 221 )</option>
                                                    <option value="381">Serbia ( 381 )</option>
                                                    <option value="381">Serbia and montenegro ( 381 )</option>
                                                    <option value="248">Seychelles ( 248 )</option>
                                                    <option value="232">Sierra leone ( 232 )</option>
                                                    <option value="65">Singapore ( 65 )</option>
                                                    <option value="1">Sint maarten ( 1 )</option>
                                                    <option value="421">Slovakia ( 421 )</option>
                                                    <option value="386">Slovenia ( 386 )</option>
                                                    <option value="677">Solomon islands ( 677 )</option>
                                                    <option value="252">Somalia ( 252 )</option>
                                                    <option value="27">South africa ( 27 )</option>
                                                    <option value="0">South georgia and the south sandwich islands ( 0 )</option>
                                                    <option value="211">South sudan ( 211 )</option>
                                                    <option value="34">Spain ( 34 )</option>
                                                    <option value="94">Sri lanka ( 94 )</option>
                                                    <option value="249">Sudan ( 249 )</option>
                                                    <option value="597">Suriname ( 597 )</option>
                                                    <option value="47">Svalbard and jan mayen ( 47 )</option>
                                                    <option value="268">Swaziland ( 268 )</option>
                                                    <option value="46">Sweden ( 46 )</option>
                                                    <option value="41">Switzerland ( 41 )</option>
                                                    <option value="963">Syrian arab republic ( 963 )</option>
                                                    <option value="886">Taiwan, province of china ( 886 )</option>
                                                    <option value="992">Tajikistan ( 992 )</option>
                                                    <option value="255">Tanzania, united republic of ( 255 )</option>
                                                    <option value="66">Thailand ( 66 )</option>
                                                    <option value="670">Timor-leste ( 670 )</option>
                                                    <option value="228">Togo ( 228 )</option>
                                                    <option value="690">Tokelau ( 690 )</option>
                                                    <option value="676">Tonga ( 676 )</option>
                                                    <option value="1868">Trinidad and tobago ( 1868 )</option>
                                                    <option value="216">Tunisia ( 216 )</option>
                                                    <option value="90">Turkey ( 90 )</option>
                                                    <option value="7370">Turkmenistan ( 7370 )</option>
                                                    <option value="1649">Turks and caicos islands ( 1649 )</option>
                                                    <option value="688">Tuvalu ( 688 )</option>
                                                    <option value="256">Uganda ( 256 )</option>
                                                    <option value="380">Ukraine ( 380 )</option>
                                                    <option value="971">United arab emirates ( 971 )</option>
                                                    <option value="44">United kingdom ( 44 )</option>
                                                    <option value="1">United states ( 1 )</option>
                                                    <option value="1">United states minor outlying islands ( 1 )</option>
                                                    <option value="598">Uruguay ( 598 )</option>
                                                    <option value="998">Uzbekistan ( 998 )</option>
                                                    <option value="678">Vanuatu ( 678 )</option>
                                                    <option value="58">Venezuela ( 58 )</option>
                                                    <option value="84">Viet nam ( 84 )</option>
                                                    <option value="1284">Virgin islands, british ( 1284 )</option>
                                                    <option value="1340">Virgin islands, u.s. ( 1340 )</option>
                                                    <option value="681">Wallis and futuna ( 681 )</option>
                                                    <option value="212">Western sahara ( 212 )</option>
                                                    <option value="967">Yemen ( 967 )</option>
                                                    <option value="260">Zambia ( 260 )</option>
                                                    <option value="263">Zimbabwe ( 263 )</option>
                                                    </select>
                        </div>

				<div class="form-group">
					<label for="message" class="control-label" style="color: #fff;">Message *</label>
					<textarea rows="5" id="message" class="form-control" id="message" name="message" maxlength="700" placeholder="Please Enter Message *" required=""></textarea>
				</div>
				<div class="form-group">
					<button type="submit" name="send" class="btn btn-success" name="submit">SEND</button>
					<button type="reset" class="btn btn-primary">CLEAR</button>
				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$('form').submit(function() {
				var message = $('#message').val().trim();
				if (Boolean(message) == false) {
					alert('PLease Enter Message');
					$('#message').val('').focus();
					return false;
				}

			});
		});
	</script>
</body>

</html>