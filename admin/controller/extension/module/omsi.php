<?php
class ControllerExtensionModuleOmsi extends Controller {
    private $error = array();

    const DEFAULT_MODULE_SETTINGS = [
        'name' => 'OMSI',
        'model' => '',
        'status' => 1 /* Enabled by default*/
    ];

    public function index() {
        if (!isset($this->request->get['module_id'])) {
            $module_id = $this->addModule();
            $this->response->redirect($this->url->link('extension/module/omsi','&user_token='.$this->session->data['user_token'].'&module_id='.$module_id));
        } else {
            $this->editModule($this->request->get['module_id']);
        }
    }

    private function addModule() {
        $this->load->model('setting/module');

        $this->model_setting_module->addModule('omsi', self::DEFAULT_MODULE_SETTINGS);

        return $this->db->getLastId();
    }

    protected function editModule($module_id) {
        $data = array();

        $this->load->language('extension/module/omsi');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/module');
        $module_setting = $this->model_setting_module->getModule($module_id);
        $data['name'] = $module_setting['name'];
        $data['status'] = $module_setting['status'];

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $htmlOutput = $this->load->view('extension/module/omsi', $data);
        $this->response->setOutput($htmlOutput);
    }

    public function validate() {}

    public function install() {}

    public function uninstall() {

    }
}