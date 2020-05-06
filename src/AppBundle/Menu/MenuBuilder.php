<?php

namespace App\AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Меню на главной (версия для разработки)
     *
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild(
            'index', [
                'label' => 'Главная',
                'route' => 'index'
            ]
        );
        $menu->setChildrenAttribute('class', 'test');
        $menu->addChild(
            'login', [
                'label' => 'Войти',
                'route' => 'app_login'
            ]
        );
        $menu->addChild(
            'admin', [
                'label' => 'Админка',
                'route' => 'admin'
            ]
        );
        $menu->addChild(
            'doctorOffice', [
                'label' => 'Кабинет врача',
                'route' => 'patients_list'
            ]
        );
        $menu['index']->setAttribute('class', 'btn');
        $menu['index']->setAttribute('icon', 'fa fa-tasks');

        return $menu;
    }

    /**
     * Меню админки (версия для разработки)
     *
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createAdminMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'metro');
        $menu->addChild(
            'index', [
                'label' => 'Главная',
                'route' => 'index'
            ]
        );
        // $menu->addChild('admin', ['label' => 'Админка', 'route' => 'admin'])->setAttribute('icon', 'fa fa-list');
        $menu->addChild(
            'authUserList', [
                'label' => 'Пользователи',
                'route' => 'auth_user_index'
            ]
        );
        $menu->addChild(
            'patientsList', [
                'label' => 'Пациенты',
                'route' => 'patient_index'
            ]
        );
        $menu['patientsList']->addChild(
            'patientsNew', [
                'label' => 'Добавить',
                'route' => 'patient_new'
            ]
        );
        $menu['patientsList']->addChild(
            'patientTestingList', [
                'label' => 'Сдача анализов',
                'route' => 'patient_testing_index'
            ]
        );
        $menu->addChild(
            'regionsList', [
                'label' => 'Регионы',
                'route' => 'region_index'
            ]
        );
        $menu->addChild(
            'countriesList', [
                'label' => 'Страны',
                'route' => 'country_index'
            ]
        );
        $menu->addChild(
            'roleList', [
                'label' => 'Роли',
                'route' => 'role_index'
            ]
        );
        $menu->addChild(
            'cityList', [
                'label' => 'Города',
                'route' => 'city_index'
            ]
        );
        $menu->addChild(
            'diagnosisList', [
                'label' => 'Диагнозы',
                'route' => 'diagnosis_index'
            ]
        );
        $menu->addChild(
            'districtList', [
                'label' => 'Районы',
                'route' => 'district_index'
            ]
        );
        $menu->addChild(
            'hospitalList', [
                'label' => 'Больницы',
                'route' => 'hospital_index'
            ]
        );
        $menu->addChild(
            'polimorphismList', [
                'label' => 'Полиморфизмы',
                'route' => 'polimorphism_index'
            ]
        );
        $menu->addChild(
            'riskFactor', [
                'label' => 'Управление рисками',
//                'route' => 'risk_factor_index'
            ]
        );
        $menu['riskFactor']->addChild(
            'riskFactorList', [
                'label' => 'Факторы риска',
                'route' => 'risk_factor_index'
            ]
        );
        $menu['riskFactor']->addChild(
            'riskFactorTypeList', [
                'label' => 'Типы факторов риска',
                'route' => 'risk_factor_type_index'
            ]
        );
        $menu['riskFactor']->addChild(
            'preventWayList', [
                'label' => 'Способы профилактики рисков',
                'route' => 'prevention_way_index'
            ]
        );
        $menu->addChild(
            'analysis', [
                'label' => 'Управление анализами',
            ]
        );
        $menu['analysis']->addChild(
            'analysisGroupList', [
                'label' => 'Группы анализов',
                'route' => 'analysis_group_index'
            ]
        );
        $menu['analysis']->addChild(
            'analysisList', [
                'label' => 'Анализы',
                'route' => 'analysis_index'
            ]
        );
        $menu['analysis']->addChild(
            'analysisRateList', [
                'label' => 'Нормальные значения',
                'route' => 'analysis_rate_index'
            ]
        );
        $menu->addChild(
            'measureList', [
                'label' => 'Единицы измерения',
                'route' => 'measure_index'
            ]
        );
        $menu->addChild(
            'trimesterList', [
                'label' => 'Триместры',
                'route' => 'trimester_index'
            ]
        );
        return $menu;
    }

    /**
     * Меню кабинета врача в header
     *
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createDoctorOfficeHeaderMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'main-nav__list');
        $menu->addChild(
            'help', [
                'label' => 'Помощь',
                'route' => 'doctor_office_help'
            ]
        );
        return $menu;
    }

    /**
     * Меню кабинета врача в sidebar
     *
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createDoctorOfficeSidebarMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'sidebar__list');
        $menu->addChild(
            'patientsList', [
                'label' => 'Пациенты',
                'route' => 'patients_list'
            ]
        );
//        $menu->addChild('hospitalsList', [
//                'label' => 'Больницы',
//                'route' => 'hospitals_list'
//            ]
//        );
        return $menu;
    }
}
