<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 09.07.19
 * Time: 17:03
 */

namespace Roma\B2BCustomers\Api\Data;


interface B2BInterface
{
    const TABLE_NAME                = 'b2b_customers';

    const ID_FIELD                  = 'customer_id';
    const FIRST_NAME_FIELD          = 'first_name';
    const LAST_NAME_FIELD           = 'last_name';
    const CODE_FIELD                = 'code';

    const CACHE_TAG                 = 'roma_b2bcustomers';

    const REGISTRY_KEY              = 'b2bcustomers_b2bcustomers';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getFirstName();

    /**
     * @param string $firstName
     * @return \Roma\B2BCustomers\Api\Data\B2BInterface
     */
    public function setFirstName($firstName);

    /**
     * @return mixed
     */
    public function getLastName();

    /**
     * @param string $lastName
     * @return \Roma\B2BCustomers\Api\Data\B2BInterface
     */
    public function setLastName($lastName);

    /**
     * @return mixed
     */
    public function getCode();

    /**
     * @param string $code
     * @return \Roma\B2BCustomers\Api\Data\B2BInterface
     */
    public function setCode($code);
}