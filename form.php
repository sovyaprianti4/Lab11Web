<?php
class Form
{
    private $fields = [];
    private $action;
    private $submit;

    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function addField($name, $label, $type = "text", $options = [])
    {
        $this->fields[] = [
            'name' => $name,
            'label' => $label,
            'type' => $type,
            'options' => $options
        ];
    }

    public function displayForm()
    {
        echo "<form action='$this->action' method='POST'><table>";

        foreach ($this->fields as $f) {
            echo "<tr><td>{$f['label']}</td><td>";

            switch ($f['type']) {
                case 'textarea':
                    echo "<textarea name='{$f['name']}'></textarea>";
                    break;

                case 'select':
                    echo "<select name='{$f['name']}'>";
                    foreach ($f['options'] as $v => $l) {
                        echo "<option value='$v'>$l</option>";
                    }
                    echo "</select>";
                    break;

                case 'radio':
                    foreach ($f['options'] as $v => $l) {
                        echo "<input type='radio' name='{$f['name']}' value='$v'> $l ";
                    }
                    break;

                case 'checkbox':
                    foreach ($f['options'] as $v => $l) {
                        echo "<input type='checkbox' name='{$f['name']}[]' value='$v'> $l ";
                    }
                    break;

                case 'password':
                    echo "<input type='password' name='{$f['name']}'>";
                    break;

                default:
                    echo "<input type='text' name='{$f['name']}'>";
            }

            echo "</td></tr>";
        }

        echo "<tr><td colspan='2'><input type='submit' value='$this->submit'></td></tr>";
        echo "</table></form>";
    }
}
?>