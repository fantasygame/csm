<!DOCTYPE html>
<?php
require './autoload.php';
spl_autoload_register('autoload');
$db = new Database('localhost', 'root', '', 'mysql', 'csm');
?>
<html>
	<head>
		<title>Character Sheet Manager</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body>
		<form method="post" action="form.php">
			<table>
				<tr>
					<th>Imię postaci</th>
					<td><input type="text" name="name"/></td>
				</tr>
				<tr>
					<th>Rasa</th>
					<td>
						<select name="race">
							<option value="1">Człowiek</option>
							<option value="2">Krasnolud</option>
							<option value="3">Elf</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Wygląd</th>
					<td><input type="text" name="appearance"/></td>
				</tr>
				<tr>
					<th>Archetyp</th>
					<td><input type="text" name="archetype"/></td>
				</tr>
				<tr>
					<th>Opis</th>
					<td><input type="text" name="description"/></td>
				</tr>
				<tr>
					<th>Doświadczenie</th>
					<td><input type="text" name="exp"/></td>
				</tr>
				<tr>
					<th>Atrybuty</th>
					<td>
						<?php
						$baseAttributeRepository = new BaseAttributeRepository($db);
						$attributes = $baseAttributeRepository->getAll();

						for ($i = 0; $i < count($attributes); $i++) {
							$attribute = $attributes[$i];
							echo '<input type="checkbox" name="attributes[' . $attribute->getId() . ']" value="' . $attribute->getId() . '"/> ' . $attribute->getName();
							echo '<input type="text" name="attributes[' . $attribute->getId() . '][value]" /><br/>';
						}
						?>
					</td>
				</tr>
				<tr>
					<th>Umiejętności</th>
					<td>
						<?php
						$baseSkillRepository = new BaseSkillRepository($db);
						$skills = $baseSkillRepository->getAll();

						for ($i = 0; $i < count($skills); $i++) {
							$skill = $skills[$i];
							echo '<input type="checkbox" name="skills[' . $skill->getId() . ']" value="' . $skill->getId() . '"/> ('.$skill->getAttribute()->getName().') ' . $skill->getName();
							echo '<input type="text" name="skills[' . $skill->getId() . '][value]" /><br/>';
						}
						?>
					</td>
				</tr>
				<tr>
					<th>Przewagi</th>
					<td>
						<?php
						$edgeRepository = new EdgeRepository($db);
						$edges = $edgeRepository->getAll();

						for ($i = 0; $i < count($edges); $i++) {
							$edge = $edges[$i];
							echo '<input type="checkbox" name="edges[]" value="' . $edge->getId() . '"/> ' . $edge->getName() . '<br/>';
						}
						?>
					</td>
				</tr>
				<tr>
					<th>Zawady</th>
					<td>
						<?php
						$hindranceRepository = new HindranceRepository($db);
						$hindrances = $hindranceRepository->getAll();

						for ($i = 0; $i < count($hindrances); $i++) {
							$hindrance = $hindrances[$i];
							echo '<input type="checkbox" name="hindrances[]" value="' . $hindrance->getId() . '"/> ' . $hindrance->getName() . '<br/>';
						}
						?>
					</td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<th></th>
					<td></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>