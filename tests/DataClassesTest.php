<?php
/**
 * @file
 * Contains \EyalShalev\Pwned\DataClassesTest
 */

namespace EyalShalev\Pwned;


class DataClassesTest extends ClientTestBase
{

    protected $requiredDataClasses = [];

    public function testDataClasses()
    {
        $data_classes = $this->client->getDataClasses();

        $this->assertInternalType('array', $data_classes);

        $this->assertArraySubset(
          $this->requiredDataClasses,
          $data_classes,
          false
        );
    }


    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->requiredDataClasses = [
          "Account balances",
          "Age groups",
          "Astrological signs",
          "Avatars",
          "Bank account numbers",
          "Banking PINs",
          "Beauty ratings",
          "Biometric data",
          "Car ownership statuses",
          "Career levels",
          "Credit cards",
          "Customer feedback",
          "Customer interactions",
          "Dates of birth",
          "Device usage tracking data",
          "Drinking habits",
          "Drug habits",
          "Education levels",
          "Email addresses",
          "Email messages",
          "Employers",
          "Ethnicities",
          "Family members' names",
          "Family plans",
          "Financial transactions",
          "Fitness levels",
          "Genders",
          "Geographic locations",
          "Government issued IDs",
          "Historical passwords",
          "Home addresses",
          "Home ownership statuses",
          "Homepage URLs",
          "Income levels",
          "Instant messenger identities",
          "IP addresses",
          "Job titles",
          "MAC addresses",
          "Marital statuses",
          "Names",
          "Nicknames",
          "Parenting plans",
          "Passport numbers",
          "Password hints",
          "Passwords",
          "Payment histories",
          "Personal descriptions",
          "Personal interests",
          "Phone numbers",
          "Physical attributes",
          "Political views",
          "Private messages",
          "Purchases",
          "Races",
          "Recovery email addresses",
          "Relationship statuses",
          "Religions",
          "Reward program balances",
          "Salutations",
          "Security questions and answers",
          "Sexual fetishes",
          "Sexual orientations",
          "Smoking habits",
          "SMS messages",
          "Social connections",
          "Spoken languages",
          "Time zones",
          "Travel habits",
          "User agent details",
          "User website URLs",
          "Usernames",
          "Website activity",
          "Work habits",
          "Years of birth",
        ];
    }
}
