<?php
session_destroy();
header("Location: ".ROOT."?url=index&logout=success");
