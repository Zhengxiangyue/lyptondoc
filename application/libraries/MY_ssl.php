<?php
/**
 * Created by PhpStorm.
 * User: Cancel
 * Date: 8/3/2017
 * Time: 11:22 AM
 */

class MY_ssl
{

    public static function encrypt($data)
    {
        if (openssl_public_encrypt($data, $encrypted, self::$public_key))
            $data = base64_encode($encrypted);
        else
            throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');

        return $data;
    }

    public static function decrypt($data)
    {
        if (openssl_private_decrypt(base64_decode($data), $decrypted, self::$private_key))
            $data = $decrypted;
        else
            $data = false;

        return $data;
    }

    public static function private_encrypt($data)
    {
        if (openssl_public_encrypt($data, $encrypted, self::$private_key))
            $data = base64_encode($encrypted);
        else
            throw new Exception('Unable to encrypt data. Perhaps it is bigger than the key size?');

        return $data;
    }

    public static function public_decrypt($data)
    {
        if (openssl_private_decrypt(base64_decode($data), $decrypted, self::$public_key))
            $data = $decrypted;
        else
            $data = false;

        return $data;
    }

    private static $private_key = '-----BEGIN RSA PRIVATE KEY-----
MIIJJwIBAAKCAgEA2RZ3jwaY4zSru1nXWtb3yvbNBnbZMpLlmPpGb9toJf4OPw9R
GAHIC/MqwXQQ11BKO+ritJM5qrVtRMXwxfZ9ldwnIJjcBgQGguV2EgDsDCg/pSV2
XPknD7RrSE/JmMLEy7kNqQhiuJgafYifHxL0zZK0FZkie5eu44wzKE4HL/1BAES6
WwUs6H76lUdMHCkwx8Kkb23DAwnXAbde4+4tsiwPog0vMvpZqf4ooGpVSoZAVFTm
IBnbtk44XF3Mo5Chxk//KORdNSFbc8dtz4N0KCia/sLrTYdQE9p5sHIKhlq/vzGW
4r4TbkcAeMR1RsrvN/dQYKLHVoEty3dM2nzdJvSOkwgtDJyjNGvto/aAw/loKkzC
AXCkxrySVuk8JkbKBRj0O2WCrPe9TnBfGDEOwW0kEe6ZGRuclMv4qPKLdcgD7IhQ
l5/SaZ+EueSIdpwH6nKFGncl4aStLuUmD13GPVTO8wEWBSu6Ng1EerYSBxKWQzsq
MxBg+qtmEu3MXfopusGoZLIXWfN+c+kBwZm5SQWrOA5GrS3qIUwQIHuB7GxO9ewm
0DvpNbBWqpfyfqY48tz2s9Ch77AgKBzN8ciYaxv3dHfJWkHaOlxPfLQ0QEWwSYhc
/ol5PVbHO+juFMNlnnI6+3zYjHy+9KLoqBcD6S7wZH2sIYcB6prZ1KL6PeECAwEA
AQKCAgBHWngfvbZg774GjYgYZpH511caadQIKHpo5tJiD8bSvgemuH0aG/PJ4bpK
7cBfVRehTBoJ6l5I+usYcMsr9lHfAQanUzb2jzooqg0966mqcUxCFucptgcdxVqB
4R/NIy+WGpQf3A6+x9flLRPIHe3y5+ZjNvs7jmbAiiOCeusn3eEQmoZ6RmA1Zw8s
I8wjcXKEJjjwGy6+/+v4t3HsDyxb5NmalSTPZ7QzCMQHvgucvDXGwkUFhhpOeLVT
vsz1ciOKUF747N6qCPXLP2CblYSHcplHZX/78p7id6wJz+IfuRJPYJhMnNc8JwBD
sacuhqNMTPDRYo+MolcQCn1rTyFNAjSEuyabdWQlU9at1kL5pAl/G3Co+EM/zUUA
jRXxMTd6TOGxwgsoAwQxd1E/RTZKw8FkC+ozc8RYjfUBMs6PX6Qmged+XQZmMQNR
MabTuN6ZHB1dkcNTIFWUdgkKysiNqL3Pfm0rMPLA21wtSoKl+cMPpHACTLdYc67g
vcEfsKrxeXazlHFg6kWA7T9c10fhL7UNvnP9zRnRLGTVY+cvENVgoav6lRQC53eP
qw0oYOMu0Pe/u5NBWGc40fmH3as/5tOCO93Svxjoy0JhtizRkE5Phe96PrhH35Gu
6f7+v7EhwknnytCPsgxBFK+izZEroysuCImHQC8s5DbbPAASVQKCAQEA/T2b8/RB
55vF+neuuzGMKHk2YlwBo041W4HwBdX9cHrOLGm6pNnvp60oHU+3Y/6MFrPNwy3S
yvbqQV4WDNhAEsrrl7YQBu1cdEYVfut0JhfUptv/2opN/WIV76UFkGTkX5CmB+n5
GWXJqTDYJG3LDZClnrSNorm5iEWwoo1tIRSh8KJW917cRf2MPbc+PO8oe1HgvvQf
Mh4KC6Tbvwf1chxxe1gt/oIpS7jCIAR10KGhU+qKMbkECVKyxYmOhXtWLXfig635
z4Tyw78ypqu8sraZ48/mrZLpFVHRmNxXGWFxRcV9+bvnic/XmIa1IrFlkofj4LGJ
xvRNIFMC3NDU7wKCAQEA23QDQ6wAxNcBlUSkUvAMsyA8PorJxuTt531oLsBq5nC7
6sU0L1/aM5LuS7UDw+HG0B7EGcGJ3agrgaLqLYsoUuK4xxRvj52r80mMrRvt/NU3
BwpzvhlWgDiht2QByE0yxSptZBNSCH1/dsIpCyvXMC9xkuihS71egMVebIwcvT3n
7nWBE6nSSU1J/bGGevqiIcOhBbC/JdxAD1MoZTDyqcJP4DELc3UMYB54kgSZA6jv
QBI0EC3r+fxsKfK1cJfvXUp4ZdbSG/AxZ+tGoqzS2leWCoG0tK/nX5c1YkPoWCuj
j2lnKT0PBWchsCLxyY0NxiLeq0TfTBS7oumbv+s6LwKCAQA34+EHdmEVPMv0+3UU
21qTlCzsiGHUKO6dw4+1ugS1TmUyaCNJPtAlsZGo5m8TIprIZ+aBrRtYsCYDR0CW
lSOPAjn8wbHH1ZsSDmWwHUcFIT1NlkBheyS7R2qP+VvBAoNklAgQtxLDCDP5o04Q
vCqUU9g5rp+TymmoKblSJuRu6J7U/P80mTsEN3E8LbUOvbmxfeCcRESeSwLsjvXw
s1D4Xk6taki8Yv26OIyfhFx8Ly/r1VeqoarCY/4QmstZql7aqhrT9RGtOypZCVmk
b0K2LpbIMJo4tLO8gNJBal/OujLFs1CaTV5MjBKJFzHi9kP0kwk4DfbachCTkb6P
/YcBAoIBAAw1chELuqc4xu/E99ddX3d/rZpVIlCcX9fnFCq1rbzQPMQc4IBaNstz
uyofEeyN3P+rFoHQUJkyR+lYZOrPuRiTYHBC5Mn6nZxVVSw0R5MvUXZk0Hec9UEA
5Y5MVAUOtmpdp+RPZtruEG9M8febIsedfBYONxr9mApV8KDdUqP8k7CifOHZKsfF
Mv6YJ8EjvG1gcs7cPGYg0LeJis/GX1muY783O0nbEystxsto0hJwDY9k89yKkXxA
3MugoxN2gGySPgx8XQgM3tLHNhDKyJg5EzHWcXUz7A1XXjLvUDfHhbvuwzx6FyHX
0Pn5l7X80O1a90RT+pBC/wVbNb0BmyUCggEAcfxYfeuY7aIU8rN1ZocxpLmkfEPu
kpr+EiKV7WvkVT4+qosE/jS677rADofCY5oR7Le4b+AAZvGd7fPgE516Gze6uorX
z36DcPWLx1HRE26a2bImbABIqyn5PGr0r0bjKH73uv4KDH7pqo7bNf8rSC7ug1oa
tDqNv+7I27K9qUw6rzI4JftZvDq6l2Kf7GHERwScAi0m6XAqQh8IlowTZf2gEa8S
gq4bNdUXtf/WPrdE/N7BZ3feOlNIj8x6zh/V2wzYQ8Uk3EFu5c3/FpG9zrcoQnFP
F2TZgPPGkraXX7clMa1DbklQqo7U3K5F4FgGqNElPOkyQIXbMZLRkUlk8Q==
-----END RSA PRIVATE KEY-----
';

    private static $public_key = '-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEA2RZ3jwaY4zSru1nXWtb3
yvbNBnbZMpLlmPpGb9toJf4OPw9RGAHIC/MqwXQQ11BKO+ritJM5qrVtRMXwxfZ9
ldwnIJjcBgQGguV2EgDsDCg/pSV2XPknD7RrSE/JmMLEy7kNqQhiuJgafYifHxL0
zZK0FZkie5eu44wzKE4HL/1BAES6WwUs6H76lUdMHCkwx8Kkb23DAwnXAbde4+4t
siwPog0vMvpZqf4ooGpVSoZAVFTmIBnbtk44XF3Mo5Chxk//KORdNSFbc8dtz4N0
KCia/sLrTYdQE9p5sHIKhlq/vzGW4r4TbkcAeMR1RsrvN/dQYKLHVoEty3dM2nzd
JvSOkwgtDJyjNGvto/aAw/loKkzCAXCkxrySVuk8JkbKBRj0O2WCrPe9TnBfGDEO
wW0kEe6ZGRuclMv4qPKLdcgD7IhQl5/SaZ+EueSIdpwH6nKFGncl4aStLuUmD13G
PVTO8wEWBSu6Ng1EerYSBxKWQzsqMxBg+qtmEu3MXfopusGoZLIXWfN+c+kBwZm5
SQWrOA5GrS3qIUwQIHuB7GxO9ewm0DvpNbBWqpfyfqY48tz2s9Ch77AgKBzN8ciY
axv3dHfJWkHaOlxPfLQ0QEWwSYhc/ol5PVbHO+juFMNlnnI6+3zYjHy+9KLoqBcD
6S7wZH2sIYcB6prZ1KL6PeECAwEAAQ==
-----END PUBLIC KEY-----';

}