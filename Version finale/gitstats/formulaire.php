<?php
session_start();
session_unset();

?>
<HTML>
	<HEAD>
		<TITLE>
			Application Github Stats
		</TITLE>
	</HEAD>
	
	<BODY>
		<CENTER><H1>Application Github Stats</H1></CENTER>
		<BR>
		<FORM NAME="formapplication" ACTION="cible.php" METHOD="POST">
			<CENTER><TABLE>
				<TR>
					<TD>
						Organisation :
					</TD>
					<TD>
						<INPUT TYPE="TEXT" NAME="organisation" required>
					</TD>
				</TR>
				<TR>
					<TD><INPUT TYPE=reset VALUE="Effacer"></TD>
					<TD><INPUT TYPE=submit></TD>
				</TR>
			</TABLE></CENTER>
		</FORM>
	</BODY>
</HTML>