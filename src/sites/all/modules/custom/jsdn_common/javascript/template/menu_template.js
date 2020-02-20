{{#menu_template}}
	<div class="menu_wrapper" id="jcMenu">
	{{#menuJson}}
		<ul class="main_menu">
			{{#main_menu}}
				<li class="top"><a href="#">{{{label}}}</a>
					<ul class="clearfix">
						{{#sub_menu}}
							<li>
								<a href="{{URL}}">{{{title}}}</a>
							</li>
						{{/sub_menu}}
						
					</ul>
				</li>
			{{/main_menu}}
		
			{{#profileJson}}
				<div class="floatRight menu_right">
					<div id="profileMenu">
						<ul>
							<li>
								
									<div class="profileIcon"><a href="#">&nbsp;</a></div>
									<ul class="clearfix profileMenu">
										<li class="login_msg">
											<span class="uname">John Thomas</span>
											<br>(Customer Admin)
											</li>
										{{#main_menu}}
										{{#sub_menu}}
											<li><a href="{{URL}}"> {{{title}}} </a></li>
										{{/sub_menu}}
										{{/main_menu}}
									</ul>
								
							</li>
						</ul>	 
					</div>
				</div>	
			{{/profileJson}}
		</ul>
	{{/menuJson}}
	</div>
{{/menu_template}}