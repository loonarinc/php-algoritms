<?php

class InfixToPostfix
{
    public $mathInfix;
    public $stack;
// принимаем строку примера
    public function setMathInfix(string $mathInfix): void
    {
        $this->mathInfix = $mathInfix;
    }
    public function __construct()
    {
        $this->stack = new SplStack();
    }
//основная функция
    public function convert()
    {
        $mathPostfix = "";
//делим пример на массив
        $charArr = preg_split('//', $this->mathInfix, -1, PREG_SPLIT_NO_EMPTY);
        $n = count($charArr);
        for ($i = 0; $i < $n; $i++) {
            $ch = $charArr[$i];
//добавляем число из нескольких цифр до тех пор, пока не придет пробел или оператор
            if (is_numeric($ch)) {
                while (is_numeric($charArr[$i])) {
                    $mathPostfix .= $charArr[$i++];
                }
                $i--;
// добавляем пробел в качестве разделителя
                $mathPostfix .= ' ';
//если пришла скобка
            } elseif ($ch == '(') {
// пушим её в стек
                $this->stack->push($ch);
//если пришла правая скобка
            } elseif ($ch == ')') {
// достаем из стека операторы, пока не уткнемся в левую скобку
                while ($this->stack->top() != '(') {
                    $mathPostfix .= $this->stack->pop() . ' ';
                }
// и удаляем левую скобку
                $this->stack->pop();
//а если оператор
            } else if (toolFunc::isOperator($ch)) {
// то проверяем на приоритет операции и добавляем в постфикс сперва с бОльшим
                while (!$this->stack->isEmpty() &&
                    toolFunc::priority($this->stack->top()) >= toolFunc::priority($ch)) {
                    $mathPostfix .= $this->stack->pop() . ' ';
                }
//а если нет, то пушим в стек
                $this->stack->push($ch);
            }
            else if (toolFunc::isParameter($ch)){
                $mathPostfix .= $charArr[$i]. ' ';
            }
        }
// после окончания проверки примера в стеке еще есть операторы. Вытаскиваем их
        while (!$this->stack->isEmpty()) {
            $mathPostfix .= $this->stack->pop() . ' ';
        }
//возвращаем готовый пример в постфиксной форме
        return $mathPostfix;
    }
}

//класс для пары общих функций
class toolFunc
{

    public static function isOperator($ch)
    {
        $operators = ['^', '*', '/', '+', '-'];
        return in_array($ch, $operators);
    }
    public static function isParameter($ch){
        $parameters = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y',
            'z'];
        return in_array($ch, $parameters);
    }

    public static function priority($operator)
    {
        switch ($operator) {
            case '^' :
                return 3;
            case '*' :
            case '/' :
                return 2;
            case '+' :
            case '-' :
                return 1;
        }
        return 0;
    }
}

echo 'infix:   ' . $infix = '(x+42)^2+7*y-z' . PHP_EOL;

$infixToPostfix = new InfixToPostfix();
$infixToPostfix->setMathInfix($infix);
echo 'postfix: ' . $postfix = $infixToPostfix->convert() . PHP_EOL;
$arr = explode(" ", $postfix);
class BinaryNode {
    public $value;
    public $left;
    public $right;
    public function __construct( $value )
    {
        $this->value = $value;
        $this->right = null;
        $this->left = null;
    }
}
class BinaryTree {
    protected $root;
    public function __construct()
    {
        $this->root = null;
    }
    public function isEmpty() {
        return $this->root === null;
    }
    public function insert($item) {
        $node = new BinaryNode($item);
        if($this->isEmpty()) {
            $this->root = $node;
        } else {
            $this->insertNode($node, $this->root);
        }
    }
    protected function insertNode( $node, &$subtree) {
        if($subtree === null) {
            $subtree = $node;
        }
        else {
            if($node->value > $subtree->value) {
                $this->insertNode($node, $subtree->right);
            } else if($node->value < $subtree->value) {
                $this->insertNode($node, $subtree->left);
            } else {
            }
        }
    }
    protected function &findNode($value, &$subtree) {
        if(is_null($subtree)) {
            return false;
        }
        if($subtree->value > $value) {
            return $this->findNode($value, $subtree->left);
        }
        elseif ($subtree->value < $value) {
            return $this->findNode($value, $subtree->right);
        } else {
            return $subtree;
        }
    }
    public function delete($value) {
        if($this->isEmpty()) {
            throw new \Exception('Tree is emtpy');
        }
        $node = &$this->findNode($value, $this->root);
        if($node) {
            $this->deleteNode($node);
        }
        return $this;
    }
    protected function deleteNode( BinaryNode &$node) {
        if( is_null ($node->left)  && is_null($node->right)) {
            $node = null;
        }
        elseif (is_null($node->left)) {
            $node = $node->right;
        }
        elseif (is_null($node->right)) {
            $node = $node->left;
        }
        else {
            if(is_null($node->right->left)) {
                $node->right->left = $node->left;
                $node = $node->right;
            }
            else {
                $node->value = $node->right->left->value;
                $this->deleteNode($node->right->left);
            }
        }
    }
}

function arrayToTree($arr)
{
    $tree = new BinaryTree();
    foreach($arr as $ar)
    {
        $tree->insert($ar);
    }
    echo "<pre>";
    var_dump($tree);
    echo "</pre>";
}
arrayToTree($arr);