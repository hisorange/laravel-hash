<?php
return array(
	// Algorithm used to hash @ http://us3.php.net/manual/en/function.hash.php
	'algorithm' => 'sha1',
	// Added salt's length, hash length will be extended with this amount, this means an sha1 hash will be (40 chr hash + 32 chr salt) long.
	'salt_length' => 32,
	// Used alphabet for generating hash salt, setted to be alike hexa results.
	'salt_alphabet' => '0123456789abcdef',
);