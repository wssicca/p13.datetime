# P13/DateTime

Este é um pacote de classes para manipulação de data/hora em PHP. Como você 
perceberá com uma rápida olhada no código, boa parte das classes é uma extensão
das classes built-in de data/hora do PHP, mais especificamente \DateTime e 
\DateInterval. Outra parte é extensão de p13\datetime\DateRange. Veremos a 
seguir mais detalhes sobre essas crianças.

## Classes p13\datetime\DateTime e p13\datetime\DateInterval

As extensões de \DateTime e \DateInterval também implementam a interface
p13\datetime\ExtensionInterface, que assina um método de cast que deve tornar 
possível "transformar", por exemplo, uma instância de \DateTime em uma de Time.

## Classes p13\datetime\DateRange

A classe p13\datetime\DateRange serve para representar uma range de datas. Com 
um objeto desses, definido com a delimitação de uma data inicial e uma data 
final, podemos obter um \DatePeriod facilmente para que consigamos percorrer a 
range.

As extensões basicamente tornam mais específica a semântica da classe. Temos,
por exemplo, a classe p13\datetime\Month, que se limita ao intervalo entre o
primeiro e o último dia do mês especificado. O mesmo raciocínio vale para as 
classes p13\datetime\Week e p13\datetime\Year.