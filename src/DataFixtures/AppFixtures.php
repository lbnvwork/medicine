<?php

namespace App\DataFixtures;

use App\Entity\Diagnosis;
use App\Entity\LPU;
use App\Entity\City;
use App\Entity\OKSM;
use App\Entity\Polimorphism;
use App\Entity\PreventionWay;
use App\Entity\RiskFactor;
use App\Entity\RiskFactorType;
use App\Entity\Role;
use App\Entity\Oktmo;
use RuntimeException;
use App\Entity\Region;
use App\Entity\Country;
use App\Entity\AuthUser;
use App\Entity\District;
use App\Entity\Hospital;
use Symfony\Component\Yaml\Yaml;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const PATH_TO_CSV = 'data/AppFixtures/';

    public function load(ObjectManager $manager)
    {
        /** begin Админ */
        echo "Добавление админа\n";
        $manager->getRepository(AuthUser::class)->addUserFromFixtures('8888888888', 'Admin', 'Admin', 'ROLE_ADMIN', '111', true);
        /** end Админ */

        /** begin Роли*/
        echo "Внесение ролей\n";
        $this->addRoles($manager);
        /** end Роли*/

        /** begin OKSM */
        echo "Заполнение справочника ОКСМ\n";
        $this->setEntitiesFromCsv($manager, self::PATH_TO_CSV.'OKSM.csv', OKSM::class, ';');
        /** end OKSM */

        /** begin Страна */
        echo "Добавление России\n";
        $this->addEntitiesFromCatalog(
            $manager,
            $manager->getRepository(OKSM::class)->getRussiaCountry(),
            Country::class,
            [
                'name' => 'caption',
                'shortCode' => 'A3',
                'enabled' => true,
            ]
        );
        $manager->flush();
        /** end Страна */

        /** begin Регионы */
        echo "Заполнение справочника регионов\n";
        $russia = $manager->getRepository(Country::class)->getRussiaCountry();
        $this->setEntitiesFromCsv(
            $manager, self::PATH_TO_CSV.'regions.csv', Region::class, ';',
            [
                'code' => 'regionNumber',
                'oktmo_region_id' => null,
                'OKTMO_ID' => 'oktmoRegionId',
                'FederalDistrictID' => null,
                'FederalDistrictName' => null,
            ],
            [
                'country' => $russia,
                'enabled' => true,
            ]
        );
        $manager->flush();
        /** end Регионы */

        /** begin Адреса */
        echo "Заполнение справочника адресов\n";
        $this->setEntitiesFromCsv($manager, self::PATH_TO_CSV.'Oktmo.csv', Oktmo::class, ';', ['ID' => null]);
        /** end Адреса */

        /** begin Районы */
        echo "Заполнение справочника районов\n";
        $kurskRegion = $manager->getRepository(Region::class)->getKurskRegion();
        $this->addEntitiesFromCatalog(
            $manager,
            $manager->getRepository(Oktmo::class)->getKurskRegionDistricts(),
            District::class,
            [
                'name' => 'name',
                'region' => $kurskRegion,
                'oktmo' => Oktmo::class,
                'enabled' => true,
            ]
        );
        /** end Районы */

        // /** begin Города */
        echo "Добавление городов по Курской области\n";
        $this->addEntitiesFromCatalog(
            $manager,
            $manager->getRepository(Oktmo::class)->getKurskRegionCities(),
            City::class,
            [
                'region' => $kurskRegion,
                'name' => 'name',
                'enabled' => true,
                'oktmo' => Oktmo::class,
            ]
        );
        /** end Города */

        /** begin LPU */
        echo "Заполнение справочника ЛПУ\n";
        $this->setEntitiesFromCsv($manager, self::PATH_TO_CSV.'LPU.csv', LPU::class, '|');
        $manager->flush();
        /** end LPU */

        /** begin Больницы */
        echo "Добавление ЛПУ по Курской области\n";
        $this->addEntitiesFromCatalog(
            $manager,
            $manager->getRepository(LPU::class)->getKurskRegionLPU(),
            Hospital::class,
            [
                'region' => $kurskRegion,
                'code' => 'code',
                'name' => 'caption',
                'description' => 'fullName',
                'address' => 'address',
                'phone' => 'phone',
                'email' => 'email',
                'lpu' => LPU::class,
                'enabled' => false,
            ]
        );
        $manager->flush();
        /** end Больницы */

        /** begin Полиморфизмы */
        echo "Добавление полиморфизмов\n";
        $this->setEntitiesFromCsv($manager, self::PATH_TO_CSV.'polimorphismes.csv', Polimorphism::class, '|', [], ['enabled' => true]);
        /** end Полиморфизмы */

        /** begin Патологии (диагнозы) */
        echo "Добавление патологий (диагнозов)\n";
        $this->setEntitiesFromCsv($manager, self::PATH_TO_CSV.'mkb10.csv', Diagnosis::class, '|', [], ['enabled' => true]);
        /** end Патологии */

        /** begin Типы факторов риска */
        echo "Добавление типов факторов риска\n";
        $this->setEntitiesFromCsv($manager, self::PATH_TO_CSV.'risk_factor_types.csv', RiskFactorType::class, '|', [], ['enabled' => true]);
        /** end Типы факторов риска */

        /** begin Факторы риска */
        echo "Добавление факторов риска\n";
        $this->setEntitiesFromCsv(
            $manager,
            self::PATH_TO_CSV.'risk_factors.csv',
            RiskFactor::class,
            '|',
            [],
            ['enabled' => true],
            ['riskFactorType' => RiskFactorType::class]
        );
        /** end Факторы риска */

        /** begin Способы профилактики ВТЭО */
        echo "Добавление способов профилактики ВТЭО\n";
        $this->setEntitiesFromCsv($manager, self::PATH_TO_CSV.'prevention_way.csv', PreventionWay::class, '|', [], ['enabled' => true]);
        /** end Способы профилактики ВТЭО */
    }

    /**
     * Заполняет справочники из csv файла
     * file - путь к csv файлу
     * entityClass - имя класса заполняемых сущностей
     * delimiter - разделитель значений в csv файле
     * replaceFieldNameArr: ключ - имя поля в csv файле, значение - на какое имя свойства заменить; если значение null - не вносить данные этого поля
     * $persistArr: дополнительные свойства, которых нет в csv
     * $foreignKeyArr: массив [поле=>entity класс...] для получения объектов по внешнему ключу
     */
    public function setEntitiesFromCsv(
        ObjectManager $manager,
        string $file,
        string $entityClass,
        string $delimiter = ';',
        array $replaceFieldNameArr = [],
        array $persistArr = [],
        array $foreignkeyArr = []
    ) {
        if (!(is_readable($file))) {
            throw new RuntimeException(sprintf('Не удалось прочитать файл '.$file.'!'));
        };
        if (($handle = fopen($file, "r")) !== false) {
            $headers = array_flip(fgetcsv($handle, null, $delimiter)); //заголовки csv файла
            while (($data = fgetcsv($handle, null, $delimiter)) !== false) {
                $entityData = [];
                foreach ($headers as $headerKeyName => $headerValueId) {
                    /** проверка поля на наличие в массиве замены имени/игнорирования поля */
                    if (array_key_exists($headerKeyName, $replaceFieldNameArr)) {
                        if ($replaceFieldNameArr[$headerKeyName] == null) {
                            //если в массиве замены для данного csv заголовка значение null, игнорируем все значения столбца
                            continue;
                        } else {
                            //используем свойство с именем из массива замены
                            $entityData[lcfirst($replaceFieldNameArr[$headerKeyName])] = $data[$headerValueId];
                        }
                    } else {
                        //добавляем свойство с именем из заголовка csv файла
                        $entityData[lcfirst($headerKeyName)] = trim($data[$headerValueId]) !== '' ? trim($data[$headerValueId]) : null;
                    }
                }
                //добавляем дополнительные свойства, которых нет в csv
                foreach ($persistArr as $key => $value) {
                    $entityData[lcfirst($key)] = $value;
                }

                //меняем внешние ключи на объекты
                foreach ($foreignkeyArr as $property => $class) {
                    $entityData[lcfirst($property)] = $manager->getRepository($class)->find($entityData[lcfirst($property)]);
                }

                //выполнение сеттеров по подготовленным свойствам
                $manager
                    ->getRepository($entityClass)
                    ->setEntityData(
                        $entityData,
                        (new $entityClass()),
                        $persistArr
                    );
            }
            fclose($handle);
            $manager->flush();
        }
    }

    /**
     * Добавляет роли из yaml файла
     */
    private function addRoles(ObjectManager $manager)
    {
        $const = Yaml::parseFile('config/services/const.yaml');
        foreach ($const['parameters']['roles'] as $roleData) {
            $manager
                ->getRepository(Role::class)
                ->setEntityData(
                    $roleData,
                    (new Role())
                );
        }
    }

    /**
     * Добавляет сущности из выборки справочника, им соответствующего
     * Если значение параметра для сущности является свойтвом справочника, вызывает геттер справочника,
     * если является именем класса справочника, то добавляет текущий объект справочника, соответствующий сущности,
     * в других случаях просто добавляет значение параметра
     * $catalog - объекты справочника
     * $entityClass - класс заполняемой сущности
     * $params - массив параметров: ключ - свойство заполняемой сущности, значение - свойство справочника, имя класса справочника или любое другое значение
     */
    private function addEntitiesFromCatalog(ObjectManager $manager, array $catalog, string $entityClass, array $params)
    {
        foreach ($catalog as $catalogItem) {
            $data = [];
            //подготовка массива данных
            foreach ($params as $key => $value) {
                if (is_string($value)) {
                    $method = 'get'.ucfirst($value);
                    if (method_exists($catalogItem, $method)) {
                        //выполнение геттера
                        $data[$key] = $catalogItem->{$method}();
                    } elseif (get_class($catalogItem) == $value) {
                        //добавление сущности справочника
                        $data[$key] = $catalogItem;
                    } else {
                        $data[$key] = $value;
                    }
                } else {
                    $data[$key] = $value;
                }
            }
            //внесение подготовленных данных в бд
            $manager
                ->getRepository($entityClass)
                ->setEntityData(
                    $data,
                    (new $entityClass())
                );
        }
    }
}