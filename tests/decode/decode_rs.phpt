--TEST--
jwt_decode decodes JWTs signed with algorithms prefixed with RS
--FILE--
<?php
require_once __DIR__ . '/../functions.php';

$encode = partial('jwt_encode', TOKEN_CLAIMS, RSA_PRIVATE_KEY);

$tokens = [
	$encode(JWT_ALGO_RS256), 
  $encode(JWT_ALGO_RS384),
  $encode(JWT_ALGO_RS512)
];

$acc    = [];
$algos  = [JWT_ALGO_RS256, JWT_ALGO_RS384, JWT_ALGO_RS512];

for ($idx = 0; $idx < count($tokens); $idx += 1) {
	$acc[] = jwt_decode($tokens[$idx], RSA_PUBLIC_KEY, $algos[$idx]);
}

print_r(array_merge(...$acc));
?>
--EXPECT--
Array
(
    [github] => @ace411
    [twitter] => @agiroLoki
)