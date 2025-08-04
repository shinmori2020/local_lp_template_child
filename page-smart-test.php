<?php
/**
 * Template Name: Smart Modules Test Page
 * 
 * Smart Modules システムのテスト用テンプレート
 */

get_header(); ?>

<div class="smart-test-page">
    
    <!-- Smart Hero Module テスト -->
    <?php echo do_shortcode('[hero_smart_module title="Smart Modules テスト" subtitle="新しいモジュールシステムの動作確認中" cta_text="テスト実行中"]'); ?>
    
    <!-- Smart Problem Module テスト -->
    <?php echo do_shortcode('[problem_smart_module title="テスト用課題セクション" subtitle="システムの動作を確認しています"]'); ?>
    
    <!-- テスト情報表示 -->
    <section style="padding: 40px 20px; background: #f8f9fa; text-align: center;">
        <div style="max-width: 800px; margin: 0 auto;">
            <h2>🧪 Smart Modules テスト結果</h2>
            
            <?php if (class_exists('SmartModuleLoader')): ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 20px 0;">
                    ✅ <strong>Smart Modules システム：正常動作</strong>
                </div>
                
                <?php 
                $stats = SmartModuleLoader::get_stats();
                if (class_exists('SmartConflictManager')):
                    $conflict_stats = SmartConflictManager::get_instance()->get_conflict_stats();
                ?>
                    <table style="width: 100%; border-collapse: collapse; margin: 20px 0; background: white;">
                        <tr style="background: #e9ecef;">
                            <th style="padding: 10px; border: 1px solid #ddd;">項目</th>
                            <th style="padding: 10px; border: 1px solid #ddd;">値</th>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">準備済みモジュール</td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $stats['prepared']; ?>個</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">読み込み済みモジュール</td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $stats['loaded']; ?>個</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">ショートコード競合</td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $conflict_stats['shortcode_conflicts']; ?>個</td>
                        </tr>
                    </table>
                <?php endif; ?>
                
            <?php else: ?>
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px 0;">
                    ❌ <strong>Smart Modules システム：未読み込み</strong><br>
                    functions.php での読み込みが必要です
                </div>
            <?php endif; ?>
            
            <?php if (class_exists('CompleteModuleLoader')): ?>
                <div style="background: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 20px 0;">
                    ⚠️ <strong>modules_complete システムも動作中</strong><br>
                    競合管理システムが動作しています
                </div>
            <?php endif; ?>
            
            <div style="margin-top: 30px;">
                <h3>📋 テスト手順</h3>
                <ol style="text-align: left; max-width: 600px; margin: 0 auto;">
                    <li>上記のモジュールが正常に表示されているか確認</li>
                    <li>レスポンシブ対応をモバイルで確認</li>
                    <li>管理画面で「Smart Modules」メニューを確認</li>
                    <li>ACFフィールドでカスタマイズを試行</li>
                </ol>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>