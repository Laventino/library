<?php
// Schedule a shutdown in 40 minutes (2400 seconds)
exec('shutdown /s /t 2400');
echo "System will shut down in 40 minutes.\n";

exec('shutdown /a');
echo "Shutdown canceled.\n";