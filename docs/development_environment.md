# 開発環境構築

## Node.js のインストール

Node.js をインストールしてください。
macOS の場合は Homebrew でインストール可能です。

```
brew install node
```

## 依存パッケージのインストール

BcAiAssistant ディレクトリに移動し、依存パッケージをインストールします。

```
cd plugins/BcAiAssistant
npm install
```

## 開発サーバーの起動

Vite の開発サーバーを起動します。

```
npm run dev
```

Docker のコンテナ内で事項する場合は以下のコマンドで起動します。

```
npm run dev -- --host 0.0.0.0
```

## ビルド

本番用ビルドを作成する場合は以下を実行します。

```
npm run build
```

## コードスタイルチェック

Stylelint で CSS in JS のコードスタイルチェックができます。

```
npm run lint:css
```

自動修正も可能です。

```
npm run lint:css:fix
```
