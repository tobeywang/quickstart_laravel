<!DOCTYPE html>
<html lang="en">
	<head>
		@include('admin.uc.head')
	</head>
	<body class="signin">
		<section>
			<div class="signinpanel">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<!-- 登入表單段 -->
						<form id="loginForm" method="post" action="login">
                            {!! csrf_field() !!}
							<h4 class="nomargin"><?php echo env('APP_NAME')?></h4>
							<input id="qusername" name="email" placeholder="Username" class="form-control uname" maxlength="100" type="text" />
							<label class="error" for="email"></label>
							<input id="qpassword" name="password" placeholder="Password" class="form-control pword" maxlength="20" type="password" />
							<label class="error" for="password"></label>
							<input id="btnSignIn" name="btnSignIn" value="Login" class="btn btn-block btn-success" type="submit" onclick="submitForm();" />
						</form>
					</div>
					<div class="col-md-3"></div>
					<!-- col-sm-5 -->
				</div>
				<!-- row -->
				<div class="signup-footer">
					<div class="pull-left">
						<?php echo env('COPY_RIGHT')?>
					</div>
					<div class="pull-right">
						<?php echo env('CREATOR')?>
					</div>
				</div>
			</div>
			<!-- signin -->
		</section>
		@include('admin.uc.foot')
		<!-- 表單JS -->
		<script>
			//逐個偵錯
			$(function () {
				//初始化需要偵錯的表格
				$('#loginForm').validate();
				//正規表達驗證初始化
				$.validator.addMethod(
					"regex",
					function (value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					}
				);
				//各欄位
				$('#qusername').rules("add", {
					required: true,
					email: true,
					minlength: 1,
					maxlength: 100,
					messages: {
						required: "Username length must between 1-100",
						email: "Username must be an email address",
						minlength: "Username length must between 1-100",
						maxlength: "Username length must between 1-100"
					}
				});
				$('#qpassword').rules("add", {
					required: true,
					minlength: 1,
					maxlength: 20,
					messages: {
						required: "Password length must between 1-20",
						minlength: "Password length must between 1-20",
						maxlength: "Password length must between 1-20"
					}
				});
			});
			//提交與取消按鈕
			function submitForm() {
				if (!!($("#loginForm").valid()) === false) {
					return false;
				} else {
					$(document).ready(function() {
						$.blockUI({ css: {
							border: 'none',
							padding: '15px',
							backgroundColor: '#000',
							'-webkit-border-radius': '10px',
							'-moz-border-radius': '10px',
							opacity: .5,
							color: '#fff'
						}});
					});
				}
			}
			function cancelValidate() {
				$("#loginForm").validate().cancelSubmit = true;
			}
		</script>
	</body>
</html>
