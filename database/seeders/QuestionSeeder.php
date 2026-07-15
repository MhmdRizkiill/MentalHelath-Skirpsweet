<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu agar data tidak dobel saat di-seed ulang
        DB::table('questions')->delete();

        $questions = [
            ['code' => 'G01', 'question_text' => 'Saya merasa bahwa diri saya menjadi marah karena hal hal sepele.', 'category' => 'Stres'],
            ['code' => 'G02', 'question_text' => 'Saya merasa bibir saya sering kering.', 'category' => 'Kecemasan'],
            ['code' => 'G03', 'question_text' => 'Saya sama sekali tidak dapat merasakan perasaan positif.', 'category' => 'Depresi'],
            ['code' => 'G04', 'question_text' => 'Saya mengalami kesulitan bernafas (misalnya; seringkali terengah-engah atau tidak dapat bernafas padahal tidak melakukan aktifitas fisik sebelumnya).', 'category' => 'Kecemasan'],
            ['code' => 'G05', 'question_text' => 'Saya sepertinya tidak kuat lagi untuk melakukan suatu kegiatan', 'category' => 'Depresi'],
            ['code' => 'G06', 'question_text' => 'Saya cenderung bereaksi berlebihan terhadap suatu situasi', 'category' => 'Stres'],
            ['code' => 'G07', 'question_text' => "Saya merasa goyah (misalnya, kaki terasa mau 'copot')", 'category' => 'Kecemasan'],
            ['code' => 'G08', 'question_text' => 'Saya sulit untuk bersantai', 'category' => 'Stres'],
            ['code' => 'G09', 'question_text' => 'Saya menemukan diri saya berada dalam situasi yang membuat saya merasa cemas dan saya akan merasa sangat lega jika semua berakhir', 'category' => 'Kecemasan'],
            ['code' => 'G10', 'question_text' => 'Saya merasa tidak ada hal yang dapat diharapkan dimasa depan', 'category' => 'Depresi'],
            ['code' => 'G11', 'question_text' => 'Saya menemukan diri saya mudah merasa kesal.', 'category' => 'Stres'],
            ['code' => 'G12', 'question_text' => 'Saya merasa telah menghabiskan banyak energi untuk merasa cemas', 'category' => 'Stres'],
            ['code' => 'G13', 'question_text' => 'Saya merasa sedih dan tertekan', 'category' => 'Depresi'],
            ['code' => 'G14', 'question_text' => 'Saya menemukan diri saya menjadi tidak sabar ketika mengalami penundaan (misalnya: kemacetan lalu lintas, menunggu sesuatu).', 'category' => 'Stres'],
            ['code' => 'G15', 'question_text' => 'Saya merasa lemas seperti mau pingsan.', 'category' => 'Kecemasan'],
            ['code' => 'G16', 'question_text' => 'Saya merasa saya kehilangan minat akan segala hal.', 'category' => 'Depresi'],
            ['code' => 'G17', 'question_text' => 'Saya merasa bahwa saya tidak berharga sebagai seorang manusia.', 'category' => 'Depresi'],
            ['code' => 'G18', 'question_text' => 'Saya merasa bahwa saya mudah tersinggung.', 'category' => 'Stres'],
            ['code' => 'G19', 'question_text' => 'Saya berkeringat secara berlebihan (misalnya: tangan berkeringat), padahal temperatur tidak panas atau tidak melakukan aktivitas fisik sebelumnya.', 'category' => 'Kecemasan'],
            ['code' => 'G20', 'question_text' => 'Saya merasa takut tanpa alasan yang jelas.', 'category' => 'Kecemasan'],
            ['code' => 'G21', 'question_text' => 'Saya merasa bahwa hidup tidak bermanfaat.', 'category' => 'Depresi'],
            ['code' => 'G22', 'question_text' => 'Saya merasa sulit untuk beristirahat.', 'category' => 'Stres'],
            ['code' => 'G23', 'question_text' => 'Saya mengalami kesulitan dalam menelan.', 'category' => 'Kecemasan'],
            ['code' => 'G24', 'question_text' => 'Saya tidak dapat merasakan kenikmatan dari berbagai hal yang dilakukan', 'category' => 'Depresi'],
            ['code' => 'G25', 'question_text' => 'Saya menyadari kegiatan jantung, walaupun saya tidak sehabis melakukan aktivitas fisik (misalnya: merasa detak jantung meningkat atau melemah)', 'category' => 'Kecemasan'],
            ['code' => 'G26', 'question_text' => 'Saya merasa putus asa dan sedih.', 'category' => 'Depresi'],
            ['code' => 'G27', 'question_text' => 'Saya merasa bahwa saya sangat mudah marah', 'category' => 'Stres'],
            ['code' => 'G28', 'question_text' => 'Saya merasa saya hampir panik', 'category' => 'Kecemasan'],
            ['code' => 'G29', 'question_text' => 'Saya merasa sulit untuk tenang setelah sesuatu membuat saya kesal.', 'category' => 'Stres'],
            ['code' => 'G30', 'question_text' => 'Saya takut bahwa saya akan "terhambat" oleh tugas-tugas sepele yang tidak biasa saya lakukan', 'category' => 'Kecemasan'],
            ['code' => 'G31', 'question_text' => 'Saya tidak merasa antusias dalam hal apapun.', 'category' => 'Depresi'],
            ['code' => 'G32', 'question_text' => 'Saya sulit untuk sabar dalam menghadapi gangguan terhadap hal yang sedang saya lakukan', 'category' => 'Stres'],
            ['code' => 'G33', 'question_text' => 'Saya sedang merasa gelisah.', 'category' => 'Stres'],
            ['code' => 'G34', 'question_text' => 'Saya merasa bahwa saya tidak berharga.', 'category' => 'Depresi'],
            ['code' => 'G35', 'question_text' => 'Saya tidak dapat memaklumi hal apapun yang menghalangi saya untuk menyelesaikan hal yang sedang saya lakukan', 'category' => 'Stres'],
            ['code' => 'G36', 'question_text' => 'Saya sangat merasa ketakutan', 'category' => 'Kecemasan'],
            ['code' => 'G37', 'question_text' => 'Saya melihat tidak ada harapan untuk masa depan.', 'category' => 'Depresi'],
            ['code' => 'G38', 'question_text' => 'Saya merasa bahwa hidup tidak berarti.', 'category' => 'Depresi'],
            ['code' => 'G39', 'question_text' => 'Saya menemukan diri saya mudah gelisah.', 'category' => 'Stres'],
            ['code' => 'G40', 'question_text' => 'Saya merasa khawatir dengan situasi dimana saya mungkin menjadi panik dan mempermalukan diri sendiri.', 'category' => 'Kecemasan'],
            ['code' => 'G41', 'question_text' => 'Saya merasa gemetar (Misalnya: pada tangan)', 'category' => 'Kecemasan'],
            ['code' => 'G42', 'question_text' => 'Saya merasa sulit untuk meningkatkan inisiatif dalam melakukan sesuatu.', 'category' => 'Depresi'],
        ];

        DB::table('questions')->insert($questions);
    }
}