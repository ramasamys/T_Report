<div class="menu-container">
<nav>
	<ul>
		<li><a href="#">Summary</a>
		  <ul>
		    <li><a href="<? echo base_url().'index.php/summary/agentSummary'?>">Agent Summary</a></li>
		    <li><a href="<? echo base_url().'index.php/summary/queueSummary'?>">Queue Summary</a></li>
		  </ul>		
		</li>
		<li><a href="#">Reports</a>
			<ul>
				<li><a href="<? echo base_url().'index.php/report_content/'?>">IVR Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/did'?>">DID Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/queue'?>">Queue Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/outbound'?>">Outbound Report</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/outbound'?>">Predictive</a></li>
				<li><a href="<? echo base_url().'index.php/report_content/outbound'?>">Records</a></li>
			</ul>
		</li>
		<li><a href="#">PBX Admin</a>
			<ul>
				<li><a href="#">Extensions</a>
					<ul>
							<li><a href="<? echo base_url().'index.php/pbx_admin/add_extension'?>">Add extension</a></li>
							<li><a href="<? echo base_url().'index.php/pbx_admin/view_extension'?>">View extensions</a></li>
					</ul>
				</li>
				<li><a href="<? echo base_url().'index.php/pbx_admin/follow_me'?>">Follow Me</a></li>
				<li><a href="<? echo base_url().'index.php/pbx_admin/queue'?>">Queues</a></li>
				<li><a href="<? echo base_url().'index.php/pbx_admin/inbound'?>">Inbound</a></li>
			</ul>
		</li>
		<li><a href="#">Real Time Report</a></li>
	</ul>
</nav>
</div>