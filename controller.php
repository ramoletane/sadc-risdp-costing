<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

class SadcRisdpCostingPackage extends Package {

	protected $pkgHandle = 'sadc_risdp_costing';
	protected $appVersionRequired = '5.6.0';
	protected $pkgVersion = '1.4.0';

	public function getPackageHandle() {
		return t('sadc_risdp_costing');
	}

	public function getPackageName() {
		return t('SADC RISDP Costing');
	}

	public function getPackageDescription() {
		return t('Activity costing package for the revised RISDP.');
	}

	// automatically run by the package. Let's setup some events
	public function on_start() {
		$db = Loader::db();
	}

	public function install() {
		$pkg = parent::install();

		Loader::model('single_page');
		$sp = SinglePage::add('/risdp/structure/sectors', $pkg);
		$sp = SinglePage::add('/risdp/structure/implementing_agencies', $pkg);
		$sp = SinglePage::add('/risdp/structure/planning_officers', $pkg);
		$sp = SinglePage::add('/risdp/strategic_plan/immediate_outcomes', $pkg);
		$sp = SinglePage::add('/risdp/strategic_plan/targeted_output', $pkg);
		$sp = SinglePage::add('/risdp/strategic_plan/annual_output', $pkg);
		$sp = SinglePage::add('/risdp/strategic_plan/main_activities', $pkg);
		$sp = SinglePage::add('/risdp/strategic_plan/sub_activities', $pkg);
		$sp = SinglePage::add('/risdp/strategic_plan/sub_activity_costs', $pkg);
		$sp = SinglePage::add('/risdp/strategic_plan/reports', $pkg);
	}

	// update any existing installation
	public function upgrade() {
	    parent::upgrade();
	    // add single pages for projects
	    $p = Page::getByPath('/risdp/projects');
	    if ($p->isError() || (!is_object($p))) {
	        SinglePage::add('/risdp/projects', $this);
	    }
	    $p = Page::getByPath('/risdp/projects/infrastructure');
	    if ($p->isError() || (!is_object($p))) {
	    	SinglePage::add('/risdp/projects/infrastructure', $this);
	    }
	}

}

?>
