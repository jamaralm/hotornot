<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Person; // Precisamos do Model Person
use App\Models\Vote;   // Precisamos do Model Vote

class ProcessVoteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // As IDs do vencedor e do perdedor serão armazenadas aqui
    protected $winnerId;
    protected $loserId;

    /**
     * Cria uma nova instância do Job.
     * Recebe as IDs que foram despachadas pelo Controller.
     */
    public function __construct(int $winnerId, int $loserId)
    {
        $this->winnerId = $winnerId;
        $this->loserId = $loserId;
    }

    /**
     * O método 'handle' é executado quando o Job é processado pelo Worker.
     */
    public function handle(): void
    {
        // 1. Encontra as Pessoas no banco de dados
        $winner = Person::find($this->winnerId);
        $loser = Person::find($this->loserId);

        // Se uma das pessoas não for encontrada (erro de dados), paramos o Job
        if (!$winner || !$loser) {
            return;
        }

        // 2. Cria o registro do Voto (Tarefa 1.3)
        // Isso registra o evento de votação.
        Vote::create([
            'winner_id' => $winner->id,
            'loser_id' => $loser->id,
        ]);

        // 3. Lógica de Atualização do Score (Simulação ELO)
        
        // Fator K (determina o quanto a pontuação muda)
        $kFactor = 32;
        
        // E(A): Probabilidade de Vitória do Vencedor (Baseado no score)
        // Usamos uma fórmula de probabilidade de vitória baseada na diferença de scores
        // Simplesmente: quanto maior a diferença de score, menor o impacto da vitória.
        $expectedWinA = 1 / (1 + pow(10, ($loser->score - $winner->score) / 400));
        
        // CÁLCULO FINAL: Novo Score = Score Atual + K * (Resultado Real - Probabilidade de Vitória)
        // O Resultado Real para o vencedor é 1 (ganhou)
        $newScoreWinner = $winner->score + $kFactor * (1 - $expectedWinA);
        
        // E(B): Probabilidade de Vitória do Perdedor
        $expectedWinB = 1 / (1 + pow(10, ($winner->score - $loser->score) / 400));

        // O Resultado Real para o perdedor é 0 (perdeu)
        $newScoreLoser = $loser->score + $kFactor * (0 - $expectedWinB);


        // 4. Atualiza os dados no banco de dados
        
        // Atualiza o score e incrementa o total de votos recebidos
        $winner->score = round($newScoreWinner);
        $winner->votes_received++;
        $winner->save();

        // Atualiza o score e incrementa o total de votos recebidos
        $loser->score = round($newScoreLoser);
        $loser->votes_received++;
        $loser->save();
    }
}