<?php
namespace Moacir\Barramento;
use Moacir\Barramento\Message;
use Moacir\Barramento\MessageBus;
class NameChanger
{
    public function doChange($request): void
    {
        $request = str_replace('[', '', $request);
        $request = str_replace(']', '', $request);
        $request = str_replace('"', '', $request);
        $data = [
            'alunoId' => '',
            'name' => '',
        ];
        foreach (explode(',', $request) as $key => $value) {
            $pair = explode('=>', $value);
            $data[$pair[0]] = $pair[1];
        }
        $dto = new ChangeNameDTO($data['alunoId'], new Name($data['name']));
        MessageBus::getInstance()->publish(new Message()->onTopic("Aluno.update")->payload([$dto]));
    }
}
