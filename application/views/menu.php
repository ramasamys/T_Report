<div class="menu-container">
<nav>
	<ul>
		<li><a href="#">Summary</a>
		  <ul>
		    <li><a href="<? echo base_url().'index.php/summary/agent'?>">Agent Summary</a></li>
		    <li><a href="<? echo base_url().'index.php/summary/queue'?>">Queue Summary</a></li>
		  </ul>		
		</li>
		<li><a href="#">Reports</a>
			<ul>
				<li><a href="<? echo base_url().'index.php/report_content/ivr'?>">IVR Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/did'?>">DID Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/queue'?>">Queue Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/outbound'?>">Outbound Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/predictive'?>">Predictive</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/record'?>">Records</a></li>
			</ul>
		</li>
		<li><a href="#">PBX Admin</a>
			<ul>
				<li><a href="#">Extensions</a>
					<ul>
							<li><a href="<? echo base_url().'index.php/pbx_admin/createExtension'?>">Add </a></li>
							<li><a href="<? echo base_url().'index.php/pbx_admin/viewExtension'?>">View</a></li>
					</ul>
				</li>
				<li><a href="#">Follow Me</a>
					<ul>
							<li><a href="<? echo base_url().'index.php/pbx_admin/followme_insert'?>">Add</a></li>
							<li><a href="<? echo base_url().'index.php/pbx_admin/followme_list'?>">View</a></li>
					</ul>
				</li>
				<li><a href="#">Queues</a>
					<ul>
							<li><a href="<? echo base_url().'index.php/pbx_admin/queue_insert'?>">Add </a></li>
							<li><a href="<? echo base_url().'index.php/pbx_admin/queue_list'?>">View </a></li>
					</ul>
				</li>
				<li><a href="#">Inbound</a>
					<ul>
							<li><a href="<? echo base_url().'index.php/pbx_admin/inbound_insert'?>">Add </a></li>
							<li><a href="<? echo base_url().'index.php/pbx_admin/inbound_list'?>">View </a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href="#">Real Time Report</a></li>
	</ul>
</nav>
</div>