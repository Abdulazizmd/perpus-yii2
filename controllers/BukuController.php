<?php

namespace app\controllers;

use Yii;
use app\models\Buku;
use app\models\User;
use app\models\BukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use kartik\mpdf\Pdf;


/**
 * BukuController implements the CRUD actions for Buku model.
 */
class BukuController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Buku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Buku model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Buku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_kategori=null,$id_penulis=null,$id_penerbit=null)
    {
        $model = new Buku();
        $model->id_kategori = $id_kategori;
        $model->id_penulis = $id_penulis;
        $model->id_penerbit = $id_penerbit;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {

            $sampul = UploadedFile::getInstance($model, 'sampul');
            $berkas = UploadedFile::getInstance($model, 'berkas');
            // merubah nama filenya.
            $model->sampul = time() . '_' . $sampul->name;
            $model->berkas = time() . '_' . $berkas->name;
            // save data ke databases.
            $model->save(false);
            // lokasi simpan file.
            $sampul->saveAs(Yii::$app->basePath . '/web/upload/' . $model->sampul);
            $berkas->saveAs(Yii::$app->basePath . '/web/upload/' . $model->berkas);
            // Menuju ke view id yang data dibuat.
            return $this->redirect(['view', 'id' => $model->id]);

        }    
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Buku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // Mengambi data lama di databases
        $sampul_lama = $model->sampul;
        $berkas_lama = $model->berkas;

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            
            // Mengambil data baru di layout _from
            $sampul = UploadedFile::getInstance($model, 'sampul');
            $berkas = UploadedFile::getInstance($model, 'berkas');
            // Jika ada data file yang dirubah maka data lama akan di hapus dan di ganti dengan data baru yang sudah diambil jika tidak ada data yang dirubah maka file akan langsung save data-data yang lama.
            if ($sampul !== null) {
                $model->sampul = time() . '_' . $sampul->name;
                $sampul->saveAs(Yii::$app->basePath . '/web/upload/' . $model->sampul);
            } else {
                $model->sampul = $sampul_lama;
            }
            if ($berkas !== null) {
                $model->berkas = time() . '_' . $berkas->name;
                $berkas->saveAs(Yii::$app->basePath . '/web/upload/' . $model->berkas);
            } else {
                $model->berkas = $berkas_lama;
            }
            // Simapan data ke databases
            $model->save(false);
            // Menuju ke view id yang data dibuat.
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Buku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        unlink(Yii::getAlias('@web') .  '/upload/sampul/' . $model->sampul);
        unlink(Yii::getAlias('@web') .  '/upload/berkas/' . $model->berkas);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Buku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Buku::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExcel()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->setActiveSheetIndex(0);

        // Add some data
        $sheet->setCellValue('B2', 'No')
            ->setCellValue('C2', 'Nama Buku')
            ->setCellValue('D2', 'Tahun Terbit')
            ->setCellValue('E2', 'Penulis')
            ->setCellValue('F2', 'Penerbit')
            ->setCellValue('G2', 'Kategori');

        $row = 3;
        $no=1;

        foreach (Buku::find()->all() as $buku) {
            $sheet->setCellValue('B'.$row, $no)
                        ->setCellValue('C'.$row, $buku->nama)
                        ->setCellValue('D'.$row, $buku->tahun_terbit)
                        ->setCellValue('E'.$row, $buku->getNamaPenulis())
                        ->setCellValue('F'.$row, $buku->getNamaPenerbit())
                        ->setCellValue('G'.$row, $buku->getNamaKategori());

            $row++;
            $no++;
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],

            ],
        ];

        $styleArray1 = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],

            ],
        ];

        $sheet->getStyle('B2:G'.($row-1))->applyFromArray($styleArray);
        $sheet->getStyle('B2:G2')->applyFromArray($styleArray1);            

        $path = "exports/excel/";
        $filename = "Daftar Buku - ".date('YmdHis').'.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        $writer->save($path.$filename);
        return Yii::$app->getResponse()->redirect($path.$filename);
    }
    
    public function actionWord()
    {
        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();
        $header = array('size' => 16, 'bold' => true);

        // 2. Advanced table
        $section->addText(htmlspecialchars('Daftar Buku'), $header);
        $styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
        $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
        $styleCell = array('valign' => 'center');
        $styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fontStyle = array('bold' => true, 'align' => 'center');
        $phpWord->addTableStyle('style tabel', $styleTable, $styleFirstRow);
        $table = $section->addTable('style tabel');
        $table->addRow(900);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('No'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Nama Buku'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Tahun Terbit'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Penulis'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Penerbit'), $fontStyle);
        $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Kategori'), $fontStyle);

        $i = 1;
        foreach (Buku::find()->all() as $buku) {
            $table->addRow();
            $table->addCell(2000)->addText(htmlspecialchars($i));
            $table->addCell(2000)->addText(htmlspecialchars($buku->nama));
            $table->addCell(2000)->addText(htmlspecialchars($buku->tahun_terbit));
            $table->addCell(2000)->addText(htmlspecialchars($buku->getNamaPenulis()));
            $table->addCell(2000)->addText(htmlspecialchars($buku->getNamaPenerbit()));
            $table->addCell(2000)->addText(htmlspecialchars($buku->getNamaKategori()));
            $i++;
         }

        $path = "exports/word/";
        $filename = "Daftar Buku - ".date('YmdHis').'.docx';
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, "Word2007");
        $writer->save($path.$filename);
        return Yii::$app->getResponse()->redirect($path.$filename);
    }



    public function actionPdf() {
         // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reportPdfView');
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            // 'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                // 'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        $pdf->filename = date('YmdHis') . "_Daftar-Buku.pdf";

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }
}